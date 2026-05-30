<?php

namespace App\Http\Controllers;

use App\Models\nilaiKHS;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NilaiKHSController extends Controller
{
    public function index()
    {
        $nilaiKHS = nilaiKHS::all();
        return view('nilaiKHSs.index', compact('nilaiKHS'));
    }

    public function create()
    {
        return view('nilaiKHSs.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show(nilaiKHS $nilaiKHS)
    {
        return view('nilaiKHSs.show', compact('nilaiKHS'));
    }

    public function edit(nilaiKHS $nilaiKHS)
    {
        return view('nilaiKHSs.edit', compact('nilaiKHS'));
    }

    public function update(Request $request, nilaiKHS $nilaiKHS)
    {
        //
    }

    public function destroy(nilaiKHS $nilaiKHS)
    {
        $nilaiKHS->delete();
        return redirect()->route('nilaiKHS.index')->with('success', 'Data nilai KHS dihapus.');
    }
}
