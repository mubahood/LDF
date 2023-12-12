<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    public function index()
    {
        return Location::all();
    }

    public function show($id)
    {
        $location = Location::findOrFail($id);
        return response()->json($location);
    }


}
