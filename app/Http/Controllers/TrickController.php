<?php

namespace App\Http\Controllers;

use App\Models\Trick;
use Illuminate\Http\Request;

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
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Trick $trick)
    {
        //
    }

    public function edit(Trick $trick)
    {
        //
    }

    public function update(Request $request, Trick $trick)
    {
        //
    }

    public function destroy(Trick $trick)
    {
        //
    }
}
