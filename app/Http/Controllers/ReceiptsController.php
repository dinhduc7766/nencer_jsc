<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Receipt;
use App\Exports\ReceiptExport;
use Maatwebsite\Excel\Facades\Excel;

class ReceiptsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Lay toan bo du lieu tu form gui len.
        $param = $request->all();
        $receipt = Receipt::find($id);
        $receipt->status = $param['status'];
        $receipt->update();
        return redirect()->back();
    }

    public function export(Request $request) {
        $param = $request->all();
        // Tham so se la [class export, ten file excel].
        return Excel::download(new ReceiptExport($param['date']), 'receipts.xlsx');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
