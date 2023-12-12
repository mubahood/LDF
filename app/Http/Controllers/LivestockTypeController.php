<?php

namespace App\Http\Controllers;

use App\Models\LivestockType;
use Illuminate\Http\Request;

class LivestockTypeController extends Controller
{
    public function index()
    {
        return LivestockType::all();
    }

    public function show($id)
    {
        $livestockType = LivestockType::findOrFail($id);
        return response()->json($livestockType);
    }

    public function store(Request $request)
    {
        $livestockType = LivestockType::create($request->all());
        return response()->json($livestockType, 201);
    }

    public function update(Request $request, $id)
    {
        $livestockType = LivestockType::findOrFail($id);
        $livestockType->update($request->all());
        return response()->json($livestockType, 200);
    }

    public function destroy($id)
    {
        LivestockType::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
