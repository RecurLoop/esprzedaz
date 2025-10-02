<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PetService;

class PetController extends Controller
{
    private PetService $petService;

    public function __construct(PetService $petService)
    {
        $this->petService = $petService;
    }

    public function index()
    {
        $pets = $this->petService->getAll();
        return view('pets.index', compact('pets'));
    }

    public function create()
    {
        return view('pets.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|integer',
            'name' => 'required|string',
            'status' => 'required|string',
        ]);

        if ($this->petService->create($data)) {
            return redirect()->route('pets.index')->with('success', 'Pet added!');
        }
        return back()->withErrors(['msg' => 'Error adding pet']);
    }

    public function edit($id)
    {
        $pet = $this->petService->getById($id);

        if (!$pet) {
            return redirect()->route('pets.index')->withErrors(['msg' => 'Pet not found']);
        }

        return view('pets.edit', compact('pet'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'status' => 'required|string',
        ]);

        if ($this->petService->update((int)$id, $data)) {
            return redirect()->route('pets.index')->with('success', 'Pet updated!');
        }
        return back()->withErrors(['msg' => 'Error updating pet']);
    }

    public function destroy($id)
    {
        if ($this->petService->delete($id)) {
            return redirect()->route('pets.index')->with('success', 'Pet deleted!');
        }
        return back()->withErrors(['msg' => 'Error deleting pet']);
    }
}
