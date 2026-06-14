<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use App\Models\Tag;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    public function index()
    {
        $Pengumuman = Pengumuman::with('tags')->get();

        return view('Pengumuman.index', compact('Pengumuman'));
    }

    public function create()
    {
       if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $tags = Tag::all();

        return view('Pengumuman.create', compact('tags'));
    }

    public function store(Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'tags' => 'nullable|array'
        ]);

        $Pengumuman = Pengumuman::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => auth()->id()
        ]);

        $Pengumuman->tags()->attach($request->tags ?? []);

        return redirect()
            ->route('Pengumuman.index')
            ->with('success', 'Pengumuman created successfully.');
    }

    public function show(Pengumuman $Pengumuman)
    {
        $Pengumuman->load('tags');

        return view('Pengumuman.show', compact('Pengumuman'));
    }

    public function edit(Pengumuman $Pengumuman)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $tags = Tag::all();

        return view('Pengumuman.edit', compact('Pengumuman', 'tags'));
    }

    public function update(Request $request, Pengumuman $Pengumuman)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'tags' => 'nullable|array'
        ]);

        $Pengumuman->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        $Pengumuman->tags()->sync($request->tags ?? []);

        return redirect()
            ->route('Pengumuman.index')
            ->with('success', 'Pengumuman updated successfully.');
    }

    public function destroy(Pengumuman $Pengumuman)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $Pengumuman->tags()->detach();

        $Pengumuman->delete();

        return redirect()
            ->route('Pengumuman.index')
            ->with('success', 'Pengumuman deleted successfully.');
    }
}