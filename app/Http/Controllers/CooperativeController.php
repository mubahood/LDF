<?php

namespace App\Http\Controllers;

use App\Models\Cooperative;
use Illuminate\Http\Request;

class CooperativeController extends Controller
{
    public function index()
    {
        return Cooperative::all();
    }

    public function show($id)
    {
        $cooperative = Cooperative::where('user_id', $id)->firstOrFail();
        return response()->json($cooperative);
    }

    public function store(Request $request)
    {
        $cooperative = Cooperative::create($request->all());
        return response()->json($cooperative, 201);
    }

    public function update(Request $request, $id)
    {
        $cooperative = Cooperative::findOrFail($id);
        $cooperative->update($request->all());
        return response()->json($cooperative, 200);
    }

    public function destroy($id)
    {
        Cooperative::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
