<?php

namespace App\Http\Controllers;

use App\Models\ProductionRecord;
use Illuminate\Http\Request;

class ProductionRecordController extends Controller
{
    public function index()
    {
        return ProductionRecord::all();
    }

    public function show($id)
    {
        $productionRecord = ProductionRecord::where('owner_id', $id)->firstOrFail();
        return response()->json($productionRecord);
    }

    public function store(Request $request)
    {
        $productionRecord = ProductionRecord::create($request->all());
        return response()->json($productionRecord, 201);
    }

    public function update(Request $request, $id)
    {
        $productionRecord = ProductionRecord::findOrFail($id);
        $productionRecord->update($request->all());
        return response()->json($productionRecord, 200);
    }

    public function destroy($id)
    {
        ProductionRecord::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
