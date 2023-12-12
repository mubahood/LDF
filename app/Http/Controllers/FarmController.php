<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Farm;

class FarmController extends Controller
{
    public function index()
    {
        return Farm::all();
    }

    public function show($id)
    {
        $farm = Farm::where('owner_id', $id)->firstOrFail();
        return response()->json($farm);
    }

    public function store(Request $request)
    {
        $farm = Farm::create($request->all());
        return response()->json($farm, 201);
    }

    public function update(Request $request, $id)
    {
        $farm = Farm::findOrFail($id);
        $farm->update($request->all());
        return response()->json($farm, 200);
    }

    public function destroy($id)
    {
        Farm::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
