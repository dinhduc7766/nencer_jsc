<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Receipt;
use App\Exports\ReceiptExport;
use App\Models\Storage;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $storages = Storage::whereNull('storages.deleted_at')->get();
        $param = $request->all();
        // List all receipts.
        $receipts = Receipt::join(
            'storages', 'receipts.storage_id', 'storages.id'
        )->join(
            'categories', 'receipts.category_id', 'categories.id'
        )->join(
            'users', 'receipts.user_id', 'users.id'
        )->select(
            'receipts.id', 'storages.name as storage_name', 'categories.name as category_name',
            'receipts.total_price', 'receipts.quantity', 'receipts.note', 
            'receipts.delivery_date', 'receipts.type', 'users.email',
            'receipts.name as receipt_name', 'receipts.status'
        )
        ->where(function ($query) use($param) {
            if (isset($param['receipt_id'])) {
                $query->where('receipts.id', $param['receipt_id']);
            }
            if (isset($param['storage_id'])) {
                $query->where('storages.id', $param['storage_id']);
            }
            if (isset($param['status'])) {
                $query->where('receipts.status', $param['status']);
            }
            return $query;
        })
        ->orderBy('receipts.status', 'DESC')
        ->paginate(30);
        // Convert data.
        if (count($receipts) > 0) {
            foreach ($receipts as $receipt) {
                $delivery_date = Carbon::create($receipt->delivery_date);
                $receipt->delivery_date = $delivery_date->format('Y-m-d');
                $receipt->type_txt = $receipt->type == Receipt::InStock ? "Đơn nhập" : "Đơn xuất";
                $receipt->status_txt = $receipt->status == Receipt::STATUS_DONE ? "Hoàn thành" : "Đang xử lý";
            }
        }
        return view('pages.receipt.index', compact('storages', 'receipts'));
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
    public function detail(string $id)
    {
        // Find a receipt.
        $receipt = Receipt::join(
            'storages', 'receipts.storage_id', 'storages.id'
        )->join(
            'categories', 'receipts.category_id', 'categories.id'
        )->join(
            'users', 'receipts.user_id', 'users.id'
        )->select(
            'receipts.id', 'storages.name as storage_name', 'categories.name as category_name',
            'receipts.total_price', 'receipts.quantity', 'receipts.note', 
            'receipts.delivery_date', 'receipts.type', 'users.email',
            'receipts.name as receipt_name', 'receipts.status'
        )
        ->where('receipts.id', $id)->first();
        // Convert data.
        $delivery_date = Carbon::create($receipt->delivery_date);
        $receipt->delivery_date = $delivery_date->format('Y-m-d');
        $receipt->type_txt = $receipt->type == Receipt::InStock ? "Đơn nhập" : "Đơn xuất";
        $receipt->status_txt = $receipt->status == Receipt::STATUS_DONE ? "Hoàn thành" : "Đang xử lý";
        return view('pages.receipt.detail', compact('receipt'));
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
        // Sau khi update xong se quay ve trang cu
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
