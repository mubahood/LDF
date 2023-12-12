<?php

namespace App\Http\Controllers;

use App\Models\AnimalHealthRecord;
use Illuminate\Http\Request;

class AnimalHealthRecordController extends Controller
{
    public function index()
    {
        return AnimalHealthRecord::all();
    }

    public function show($id)
    {
        $animal = AnimalHealthRecord::where('owner_id', $id)->firstOrFail();
        return response()->json($animal);
    }

    public function store(Request $request)
    {
        $animal = AnimalHealthRecord::create($request->all());
        return response()->json($animal, 201);
    }

    public function update(Request $request, $id)
    {
        $animal = AnimalHealthRecord::findOrFail($id);
        $animal->update($request->all());
        return response()->json($animal, 200);
    }

    public function destroy($id)
    {
        AnimalHealthRecord::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
