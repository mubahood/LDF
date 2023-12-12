<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        return Notification::all();
    }

    public function show($id)
    {
        $location = Notification::findOrFail($id);
        return response()->json($location);
    }

    public function destroy($id)
    {
        Notification::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
