<?php

namespace App\Http\Controllers;

use App\Models\VectorAndDisease;
use Illuminate\Http\Request;

class VectorAndDiseaseController extends Controller
{
    public function index()
    {
        return VectorAndDisease::all();
    }

    public function show($id)
    {
        $vectors = VectorAndDisease::findOrFail($id);
        return response()->json($vectors);
    }

    public function store(Request $request)
    {
        $vectors = VectorAndDisease::create($request->all());
        return response()->json($vectors, 201);
    }

    public function update(Request $request, $id)
    {
        $vectors = VectorAndDisease::findOrFail($id);
        $vectors->update($request->all());
        return response()->json($vectors, 200);
    }

    public function destroy($id)
    {
        VectorAndDisease::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
