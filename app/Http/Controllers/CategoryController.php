<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Receipt;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View
     */
    public function index()
    {
        $categories = Category::with('receipts')->get();
        
        foreach ($categories as $category) {
            // Duyet tung don hang cua tung category.
            $totalReceiptInStock = 0;
            $totalReceiptOutStock = 0;
            $totalProduct = 0;
            foreach ($category->receipts as $receipt) {
                // Kiem tra xem don nhap thi cong tong
                if ($receipt->type == Receipt::InStock) {
                    $totalReceiptInStock += 1;
                }
                // Kiem tra xem don xuat thi cong tong
                if ($receipt->type == Receipt::OutStock) {
                    $totalReceiptOutStock += 1;
                }
                // Cong tong so luong san pham
                $totalProduct += $receipt->quantity;
            }
            // Sau khi tinh toan xong thi gan gia tri cho doi tuong
            $category->total_receipt_in_stock = $totalReceiptInStock;
            $category->total_receipt_out_stock = $totalReceiptOutStock;
            $category->total_product = $totalProduct;
        }
        return view('pages.category.index', compact('categories'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
