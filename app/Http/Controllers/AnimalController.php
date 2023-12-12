<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public function index()
    {
        return Animal::all();
    }

    public function show($id)
    {
        $animal = Animal::where('owner_id', $id)->firstOrFail();
        return response()->json($animal);
    }

    public function store(Request $request)
    {
        $animal = Animal::create($request->all());
        return response()->json($animal, 201);
    }

    public function update(Request $request, $id)
    {
        $animal = Animal::findOrFail($id);
        $animal->update($request->all());
        return response()->json($animal, 200);
    }

    public function destroy($id)
    {
        Animal::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}

