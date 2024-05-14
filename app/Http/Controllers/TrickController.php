<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrickRequest;
use App\Models\Trick;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Spatie\Tags\Tag;

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
        return view('tricks.create', [
            'tagOptions' => Tag::all()->map(fn ($tag) => ['value' => $tag->id, 'label' => $tag->name])->toArray(),
        ]);
    }

    public function store(TrickRequest $request)
    {
        auth()->user()
            ->tricks()
            ->create($request->validated());

        return redirect()->route('tricks.index');
    }

    public function show(Trick $trick)
    {
        return view('tricks.show', [
            'trick' => $trick,
        ]);
    }

    public function edit(Trick $trick)
    {
        Gate::authorize('update', $trick);

        return view('tricks.edit', [
            'trick' => $trick,
        ]);
    }

    public function update(TrickRequest $request, Trick $trick)
    {
        $trick->update($request->validated());

        return redirect()->route('tricks.index');
    }

    public function destroy(Trick $trick)
    {
        Gate::authorize('delete', $trick);

        $trick->delete();

        return redirect()->route('tricks.index');
    }
}
