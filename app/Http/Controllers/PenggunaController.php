<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Pengguna::query();

        if ($request->has('role')) {
            $query->where('role', $request->role);
        }

        $pengguna = $query->select(
            'id',
            'nama',
            'email',
            'nim',
            'role',
            'created_at'
        )->get();

        return response()->json([
            'status'=> 'success',
            'data'=> $pengguna,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Pengguna $pengguna)
    {
        $me = $request->user();

        if (!$me->isAdmin() && $me->id !== $pengguna->id) {
            return response()->json([
                'status'=> 'error',
                'message'=> 'Akses ditolak.',
            ], 403);
        }

        return response()->json([
            'status'=> 'success',
            'data'=> $pengguna->only(
                'id',
                'nama',
                'email',
                'nim',
                'role',
                'created_at'
            ),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengguna $pengguna)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengguna $pengguna)
    {
        $me = $request->user();

        if (!$me->isAdmin() && $me->id !== $pengguna->id) {
            return response()->json([
                'status'=> 'error',
                'message'=> 'akses ditolak.',
            ], 403);
        }

        $rules = [
            'nama'=> 'sometimes|string|max:255',
            'nim'=> 'sometimes|string|max:20|unique:users,nim,' . $pengguna->id,
            'email'=> 'sometimes|email|unique:users,email,' . $pengguna->id,
        ];

        // Hanya admin yang boleh ubah role
        if ($me->isAdmin()) {
            $rules['role'] = 'sometimes|in:mahasiswa,dosen,admin';
        }

        $request->validate($rules);

        $data = $request->only([
            'nama',
            'nim',
            'email'
        ]);

        if ($me->isAdmin() && $request->has('role')) {
            $data['role'] = $request->role;
        }

        $pengguna->update($data);

        return response()->json([
            'status'=> 'success',
            'message'=> 'Pengguna berhasil diupdate',
            'data' => $pengguna->only(
                'id',
                'nama',
                'email',
                'nim',
                'role'
            ),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengguna $pengguna)
    {
        $pengguna->delete();

        return response()->json([
            'status'=> 'success',
            'message'=> 'Pengguna berhasil dihapus',
        ]);
    }
}
