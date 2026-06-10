<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gemini\Laravel\Facades\Gemini;
use Gemini\Data\Content;
use Gemini\Data\FunctionResponse;
use Gemini\Data\Tool;
use Gemini\Data\FunctionDeclaration;
use Gemini\Enums\Role;
use App\Models\ChatBot;
use App\Models\nilaiKHS;
use App\Models\Jadwal;
use App\Models\Kehadiran;
use App\Models\Ksm;

class ChatBotController extends Controller
{
    public function index()
    {
        return view('chatbot.index');
    }

    public function history(Request $request)
    {
        $user = auth()->user();

        $history = ChatBot::where('user_id', $user->id)
            ->orderBy('created_at', 'asc')
            ->get(['role', 'message', 'created_at']);

        return response()->json([
            'success' => true,
            'history' => $history,
        ]);
    }

    public function ask(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:500',
        ]);

        $user    = auth()->user();
        $message = $request->message;

        ChatBot::create([
            'user_id' => $user->id,
            'role'    => 'user',
            'message' => $message,
        ]);

        $tools = [
    new Tool(
        functionDeclarations: [
            new FunctionDeclaration(
                name: 'ambilDataNilaiKHS',
                description: 'Mengambil data nilai KHS mahasiswa'
            ),
            new FunctionDeclaration(
                name: 'ambilDataJadwalKuliah',
                description: 'Mengambil jadwal kuliah'
            ),
            new FunctionDeclaration(
                name: 'ambilDataKehadiranAbsen',
                description: 'Mengambil data kehadiran'
            ),
            new FunctionDeclaration(
                name: 'ambilDataKsmSemester',
                description: 'Mengambil data KSM'
            ),
        ]
    )
];

        $systemText = "Kamu adalah Asisten Akademik Virtual Kampus bernama 'LintarBot'. "
            . "Nama mahasiswa saat ini: {$user->nama}, NIM: {$user->nim}. "
            . "Jawablah dengan sopan, ringkas, dan dalam Bahasa Indonesia. "
            . "Jika pertanyaan membutuhkan data akademik spesifik, panggil fungsi yang tersedia. "
            . "Jangan mengarang data — selalu gunakan fungsi untuk mengambil data nyata.";

        $systemContent = Content::parse(part: $systemText, role: Role::MODEL);

        try {
            $firstResponse = Gemini::generativeModel(
    model: 'gemini-2.0-flash'
)
->withSystemInstruction($systemContent)
->generateContent($message);

            $functionCall = $firstResponse->functionCall();

            if ($functionCall) {
                $functionName   = $functionCall->name;
                $functionResult = $this->executeAgentFunction($functionName, $user);

                $finalResponse = Gemini::generativeModel(model: 'gemini-2.0-flash')
                    ->withSystemInstruction($systemContent)
                    ->generateContent([
                        'contents' => [
                            Content::parse(part: $message, role: Role::USER),
                            Content::parse(part: $functionCall, role: Role::MODEL),
                            Content::parse(
                                part: new FunctionResponse(
                                    name: $functionName,
                                    response: ['result' => $functionResult]
                                ),
                                role: Role::USER
                            ),
                        ]
                    ]);

                $answer = $finalResponse->text();
            } else {
                $answer = $firstResponse->text();
            }
        } catch (\Exception $e) {
            \Log::error('[ChatBot Error] ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'answer'  => 'Maaf, layanan AI sedang mengalami gangguan. Silakan coba beberapa saat lagi.',
            ], 500);
        }

        ChatBot::create([
            'user_id' => $user->id,
            'role'    => 'bot',
            'message' => $answer,
        ]);

        return response()->json([
            'success' => true,
            'answer'  => $answer,
        ]);
    }

    public function clear(Request $request)
    {
        $user = auth()->user();
        ChatBot::where('user_id', $user->id)->delete();

        return response()->json(['success' => true]);
    }


    private function executeAgentFunction(string $functionName, $user): string
    {
        switch ($functionName) {
            case 'ambilDataNilaiKHS':
                $nilais = nilaiKHS::where('nim', $user->nim)->get();
                return $nilais->isNotEmpty()
                    ? $nilais->map(fn($n) => "- {$n->namaMataKuliah}: {$n->nilaiHuruf}")->join("\n")
                    : 'Data nilai KHS tidak ditemukan untuk NIM ini.';

            case 'ambilDataJadwalKuliah':
                $jadwals = Jadwal::all();
                return $jadwals->isNotEmpty()
                    ? $jadwals->map(fn($j) => "- {$j->namaMK} ({$j->ruangDanWaktu})")->join("\n")
                    : 'Jadwal kuliah tidak ditemukan.';

            case 'ambilDataKehadiranAbsen':
                $kehadirans = Kehadiran::where('namaMahasiswa', $user->nama)->get();
                return $kehadirans->isNotEmpty()
                    ? $kehadirans->map(fn($k) => "- {$k->namaMatkul}: {$k->persentase}%")->join("\n")
                    : 'Data kehadiran tidak ditemukan.';

            case 'ambilDataKsmSemester':
                $ksm = Ksm::where('nim', $user->nim)->latest()->first();
                return $ksm
                    ? "Semester {$ksm->semester}, Tahun Akademik {$ksm->tahunAkademik}"
                    : 'Data KSM tidak ditemukan.';

            default:
                return 'Fungsi tidak dikenali.';
        }
    }
}