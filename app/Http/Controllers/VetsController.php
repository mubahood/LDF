<?php

namespace App\Http\Controllers;

use App\Models\Vet;
use Illuminate\Http\Request;

class VetsController extends Controller
{
    public function index()
    {
        return Vet::all();
    }

    public function show($id)
    {
        $vet = Vet::where('user_id', $id)->firstOrFail();
        return response()->json($vet);
    }

    public function store(Request $request)
    {
        $vet = Vet::create($request->all());
        return response()->json($vet, 201);
    }

    public function update(Request $request, $id)
    {
        $vet = Vet::findOrFail($id);
        $vet->update($request->all());
        return response()->json($vet, 200);
    }

    public function destroy($id)
    {
        Vet::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
