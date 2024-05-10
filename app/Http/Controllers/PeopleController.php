<?php

namespace App\Http\Controllers;

use App\Http\Requests\PeopleRequest;
use App\Models\People;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PeopleController extends Controller
{
    public function index(): View
    {
        $peopleList = People::latest()->paginate(5);
        return view('people.index', compact('peopleList'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create(): View
    {
        return view('people.create');
    }

    public function store(PeopleRequest $request): RedirectResponse
    {
        People::create($request->validated());

        return redirect()->route('people.index')
            ->with('success', 'People created successfully.');
    }

    public function show(People $people): View
    {
        return view('people.show', compact('people'));
    }

    public function edit(People $people): View
    {
        return view('people.edit', compact('people'));
    }

    public function update(PeopleRequest $request, People $people): RedirectResponse
    {
        $people->update($request->validated());

        return redirect()->route('people.index')
            ->with('success', 'People updated successfully');
    }

    public function destroy(People $people): RedirectResponse
    {
        $people->delete();

        return redirect()->route('people.index')
            ->with('success', 'People deleted successfully');
    }

}
