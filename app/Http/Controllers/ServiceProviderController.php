<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceProvider;

class ServiceProviderController extends Controller
{
    public function index()
    {
        return ServiceProvider::all();
    }

    public function show($id)
    {
        $serviceProvider = ServiceProvider::where('user_id', $id)->firstOrFail();
        return response()->json($serviceProvider);
    }

    public function store(Request $request)
    {
        $serviceProvider = ServiceProvider::create($request->all());
        return response()->json($serviceProvider, 201);
    }

    public function update(Request $request, $id)
    {
        $serviceProvider = ServiceProvider::findOrFail($id);
        $serviceProvider->update($request->all());
        return response()->json($serviceProvider, 200);
    }

    public function destroy($id)
    {
        ServiceProvider::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
