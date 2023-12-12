<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Farmer;

class FarmerController extends Controller
{
    public function index()
    {
        return Farmer::all();
    }

    public function show($id)
    {
        $farmer = Farmer::where('user_id', $id)->firstOrFail();
        return response()->json($farmer);
    }

    public function store(Request $request)
    {
        $farmer = Farmer::create($request->all());
        return response()->json($farmer, 201);
    }

    public function update(Request $request, $id)
    {
        $farmer = Farmer::findOrFail($id);
        $farmer->update($request->all());
        return response()->json($farmer, 200);
    }

    public function destroy($id)
    {
        Farmer::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
