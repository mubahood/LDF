<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FarmActivity;

class FarmActivityApiController extends Controller
{
    public function index()
    {
        return FarmActivity::all();
    }

    public function show($id)
    {
        $farmActivity = FarmActivity::where('user_id', $id)->firstOrFail();
        return response()->json($farmActivity);
    }

    public function store(Request $request)
    {
        $farmActivity = FarmActivity::create($request->all());
        return response()->json($farmActivity, 201);
    }

    public function update(Request $request, $id)
    {
        $farmActivity = FarmActivity::findOrFail($id);
        $farmActivity->update($request->all());
        return response()->json($farmActivity, 200);
    }

    public function destroy($id)
    {
        FarmActivity::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
