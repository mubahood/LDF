<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Breed;

class BreedController extends Controller
{
    public function index()
    {
        return Breed::all();
    }


    public function store(Request $request)
    {
        $breed = Breed::create($request->all());
        return response()->json($breed, 201);
    }

    public function update(Request $request, $id)
    {
        $breed = Breed::findOrFail($id);
        $breed->update($request->all());
        return response()->json($breed, 200);
    }

    public function destroy($id)
    {
        Breed::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
