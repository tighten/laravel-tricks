<?php

namespace App\Http\Controllers;

use App\Models\Trick;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TrickController extends Controller
{
    public function index()
    {
        return view('tricks.index', [
            'tricks' => Trick::all(),
        ]);
    }

    public function create()
    {
        return view('tricks.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|min:4|unique:tricks,name',
            'description' => 'required|min:10',
            'code' => 'required',
        ]);

        auth()->user()->tricks()->create($data);

        return redirect()->route('dashboard');
    }

    public function show(Trick $trick)
    {
        //
    }

    public function edit(Trick $trick)
    {
        Gate::authorize('update', $trick);

        return view('tricks.edit', [
            'trick' => $trick,
        ]);
    }

    public function update(Request $request, Trick $trick)
    {
        Gate::authorize('update', $trick);

        $data = $request->validate([
            'name' => 'required|min:4|unique:tricks,name',
            'description' => 'required|min:10',
            'code' => 'required',
        ]);

        $trick->update($data);

        return redirect()->route('dashboard');
    }

    public function destroy(Trick $trick)
    {
        //
    }
}
