<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\ChatBot;
use App\Models\nilaiHasil;
use App\Models\Jadwal;
use App\Models\Kehadiran;
use App\Models\SuratKeterangan;
use App\Models\SuratPermohonan;
use App\Models\KalenderAkademik;
use App\Models\ukm;
use App\Models\Pengumuman;
use App\Models\historiNilai;

class ChatBotController extends Controller
{
    public function index()
    {
        return view('chatbot.index');
    }

    public function history()
    {
        $user = auth()->user();

        return response()->json([
            'success' => true,
            'history' => ChatBot::where('user_id', $user->id)
                ->orderBy('created_at', 'asc')
                ->get(['role', 'message', 'created_at']),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:500',
        ]);

        $user    = auth()->user();
        $message = $request->message;

        ChatBot::create([
            'user_id' => $user->id,
            'role' => 'user',
            'message' => $message,
        ]);

        $systemText = "Kamu adalah Asisten Akademik Virtual Kampus bernama 'Lintar Bot'. "
            . "Nama mahasiswa: {$user->nama}, NIM: {$user->nim}, bot tidak perlu menyebut nama dan nim user berkali kali, cukup diperlukan saja "
            . "Jawab sopan tapi tetap gaul menyesuaikan user, ringkas, dalam Bahasa Indonesia atau melakukan penyesuaian terhadap user. "
            . "Gunakan fungsi yang tersedia untuk data akademik. Jangan mengarang data.";

        $chatHistory = ChatBot::where('user_id', $user->id)
            ->latest()->take(20)->get()
            ->sortBy('created_at')
            ->map(fn($c) => [
                'role'    => $c->role === 'bot' ? 'assistant' : $c->role,
                'content' => $c->message,
            ])
            ->values()->toArray();

        $messages = array_merge(
            [['role' => 'system', 'content' => $systemText]],
            $chatHistory
        );

        $tools = [
            $this->buildTool('ambilDataNilaiHasil', 'Mengambil data nilai Hasil mahasiswa.'),
            $this->buildTool('ambilDataJadwalKuliah', 'Mengambil jadwal kuliah.'),
            $this->buildTool('ambilDataKehadiranAbsen', 'Mengambil data kehadiran mahasiswa.'),
            $this->buildTool('ambilDataSuratKeterangan', 'Mengambil data pengajuan surat keterangan'),
            $this->buildTool('ambilDataHistoriNilai', 'Mengambil data histori nilai mahasiswa'),
            $this->buildTool('ambilDataSuratPermohonan', 'Mengambil data pengajuan surat permohonan'),
            $this->buildTool('ambilDataPengumuman', 'Mengambil pengumuman'),
            $this->buildTool('ambilDataUKM', 'Mengambil data UKM (Unit Kegiatan Mahasiswa) yang diikuti oleh mahasiswa.'),
            $this->buildTool('ambilDataKalenderAkademik', 'Mengambil data agenda atau jadwal kegiatan kalender akademik kampus.')
        ];

        try {
            $answer = $this->callAI($messages, $tools, $user);
        } catch (\Exception $e) {
            Log::error('[ChatBot Error] ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'answer'  => 'Maaf, layanan AI sedang mengalami gangguan, mungkin tokennya bang.',
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

    public function destroy()
    {
        ChatBot::where('user_id', auth()->id())->delete();
        return response()->json(['success' => true]);
    }


    private function callAI(array $messages, array $tools, $user): string
    {
        $payload = [
            'model'=> env('AZURE_OPENAI_MODEL', 'gpt-5-mini'),
            'messages' => $messages,
            'tools'=> $tools,
            'temperature'=> 0.7,
            'max_tokens'=> 5000,
        ];

        $response = $this->sendRequest($payload);
        $choice   = $response->json('choices.0.message');


        if (!empty($choice['tool_calls'])) {
            $messages[] = $choice;

            foreach ($choice['tool_calls'] as $tc) {
                $messages[] = [
                    'role'=> 'tool',
                    'tool_call_id'=> $tc['id'],
                    'content'=> $this->executeAgentFunction($tc['function']['name'], $user),
                ];
            }

            $followUp = $this->sendRequest([
                'model'=> env('AZURE_OPENAI_MODEL', 'gpt-5-mini'),
                'messages'=> $messages,
                'temperature' => 1.0,
                'max_tokens'  => 5000,
            ]);

            return $followUp->json('choices.0.message.content');
        }

        return $choice['content'];
    }

    private function sendRequest(array $payload)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('AZURE_OPENAI_API_KEY'),
            'Content-Type'  => 'application/json',
        ])->timeout(30)->post(env('AZURE_OPENAI_ENDPOINT') . '/chat/completions', $payload);

        if (!$response->successful()) {
            throw new \Exception('API ' . $response->status() . ': ' . $response->body());
        }

        return $response;
    }

    private function buildTool(string $name, string $description): array
    {
        return [
            'type'=> 'function',
            'function' => [
                'name' => $name,
                'description' => $description,
                'parameters'  => ['type' => 'object', 'properties' => (object) []],
            ],
        ];
    }

    private function executeAgentFunction(string $fn, $user): string
    {
        return match ($fn) {
            'ambilDataNilaiHasil' => ($n = nilaiHasil::where('nim', $user->nim)->get())->isNotEmpty()
                ? $n->map(fn($r) => "- {$r->namaMataKuliah}: {$r->nilaiHuruf}")->join("\n")
                : 'Data nilai Hasil tidak ditemukan.',

            'ambilDataJadwalKuliah' => ($j = Jadwal::all())->isNotEmpty()
                ? $j->map(fn($r) => "- {$r->namaMK} ({$r->ruangDanWaktu})")->join("\n")
                : 'Jadwal kuliah tidak ditemukan.',

            'ambilDataKehadiranAbsen' => ($k = Kehadiran::where('namaMahasiswa', $user->nama)->get())->isNotEmpty()
                ? $k->map(fn($r) => "- {$r->namaMatkul}: {$r->persentase}%")->join("\n")
                : 'Data kehadiran tidak ditemukan.',

            'ambilDataSuratKeterangan' => ($sk = SuratKeterangan::where('nim', $user->nim)->get())->isNotEmpty()
                ? "Nim{$sk->nim}, Tipe Surat($sk->jenis_surat), Status surat ($sk->status)"
                : 'Data pengajuan surat keterangan tidak ditemukan',

            'ambilDataHistoriNilai' => ($hn = HistoriNilai::where('nim', $user->nim)->get())->isNotEmpty()
                ? "Nim{$hn->nim}, Tipe Surat($hn->namaMataKuliah), Nilai bobot($hn->nilai), Bobot angka($hn->bobot)"
                : 'Data histori nilai tidak ditemukan',

            'ambilDataSuratPermohonan' => ($sp = SuratPermohonan::where('nim', $user->nim)->get())->isNotEmpty()
                ? "Nim{$sp->nim}, Tipe Surat($sp->jenis_surat), Status surat ($sp->status)"
                : 'Data pengajuan surat keterangan tidak ditemukan',

            'ambilDataPengumuman' => ($pe = Pengumuman::all())->isNotEmpty()
                ? $pe->map(fn($r) => "- Tag: {$r->tags}")->join("\n")
                : 'Data pengumuman tidak ditemukan',

             'ambilDataUKM' => ($uk = ukm::where('nim', $user->nim)->get())->isNotEmpty()
                ? $uk->map(fn($r) => "- {$r->nama}: {$r->detail} (Anggota: {$r->anggota})")->join("\n")
                : 'Data UKM tidak ditemukan.',

             'ambilDataKalenderAkademik' => ($ka = KalenderAkademik::all())->isNotEmpty()
                ? $ka->map(fn($r) => "- {$r->namaKegiatan} ({$r->tanggalMulai} s/d {$r->tanggalSelesai}) [TA: {$r->tahunAkademik}]")->join("\n")
                : 'Data kalender akademik tidak ditemukan.',

            default => 'Fungsi tidak dikenali.',
        };
    }
}