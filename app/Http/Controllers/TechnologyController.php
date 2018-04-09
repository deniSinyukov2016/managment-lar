<?php

namespace App\Http\Controllers;

use App\Http\Requests\TechnologyRequest;
use App\Models\Technology;

class TechnologyController extends Controller
{
    public function index()
    {
        $technologies = Technology::query()->withCount(['projects'])->get();

        return view('technologies.index', compact('technologies'));
    }

    public function create()
    {
        return view('technologies.create');
    }

    public function store(TechnologyRequest $request)
    {
        Technology::query()->create($request->validated());

        session()->flash('status', 'Technology successfully created!');

        return redirect()->route('technologies.index');
    }

    public function edit(Technology $technology)
    {
        return view('technologies.edit', compact('technology'));
    }

    public function update(TechnologyRequest $request, Technology $technology)
    {
        $technology->update($request->validated());

        session()->flash('status', 'Technology successfully updated!');

        return redirect()->route('technologies.index');
    }

    public function destroy(Technology $technology)
    {
        $technology->delete();

        session()->flash('status', 'Technology successfully removed!');

        return redirect()->route('technologies.index');
    }
}
