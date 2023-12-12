<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FinancialRecord;

class FinancialRecordController extends Controller
{
    public function index()
    {
        return FinancialRecord::all();
    }

    public function show($id)
    {
        $financialRecord = FinancialRecord::where('farmer_id', $id)->firstOrFail();
        return response()->json($financialRecord);
    }

    public function store(Request $request)
    {
        $financialRecord = FinancialRecord::create($request->all());
        return response()->json($financialRecord, 201);
    }

    public function update(Request $request, $id)
    {
        $financialRecord = FinancialRecord::findOrFail($id);
        $financialRecord->update($request->all());
        return response()->json($financialRecord, 200);
    }

    public function destroy($id)
    {
        FinancialRecord::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
