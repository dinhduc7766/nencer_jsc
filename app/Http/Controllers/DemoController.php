<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Models\Receipt;

class DemoController extends Controller
{
    
    public function index()
    {
        //tuong duong lenh select * from categories
        $categories = Category::get(); // Eloquent
        // Ten cua file view, compact la bien du lieu tra ve view
        return view('demo', compact('categories'));
    }

    /**
     * 
     * @param Request $request
     * @param int $id of category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function detail(Request $request, $id)
    {
        $category = Category::where('id', $id)->first(); 
        return view('detail', compact('category'));
    }

    /** 
     * Controller method update an category.
     * @param Request $request
     * @param mixed $id of category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function update(Request $request, $id)
    {
        // Lay du lieu tu form
        $param = $request->all();
        $category = Category::where('id', $id)->first();
        $category->name = $param['name']; // name cua the input
        $category->update(); 
        // Goi lai file view detail sau khi update thanh cong
        return view('detail', compact('category'));
    }

    /**
     * Controller method destroy an category.
     * @param Request $request
     * @param mixed $id of category
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, $id)
    {
        $category = Category::where('id', $id)->delete();
        // dieu huong theo router
        return redirect('/demo-laravel');
    }

    public function queryBuilder(Request $request) {
        // SQL get all category
        $categories = DB::table('categories')
                ->where('created_at', '<>', 'null')
                ->orderBy('id', 'DESC')
                ->get();
        // SQL get all receipts.
        $receipts = DB::table('receipts')
                ->select(
                    'receipts.id', 'receipts.total_price', 'receipts.quantity',
                    'receipts.note', 'receipts.delivery_date', 'receipts.type',
                    'users.email',
                    'storages.name',
                    'logistics_providers.name',
                    'categories.name'
                )
                ->join('users', 'receipts.user_id', '=', 'users.id')
                ->join('categories', 'receipts.category_id', '=', 'categories.id')
                ->join('storages', 'receipts.storage_id', '=', 'storages.id')
                ->join('logistics_providers', 'receipts.logistics_provider_id', '=', 'logistics_providers.id')
                ->where('users.created_at', '<>', 'null')
                ->orderBy('users.id', 'DESC')
                ->get();
        //
        $sqlTotal = DB::table('categories')
                ->select(
                    'categories.name',
                    DB::raw('COUNT(receipts.id) AS total_receipts')
                )
                ->leftJoin('receipts', 'categories.id', '=', 'receipts.category_id')
                ->where('receipts.category_id', '=', 'categories.id')
                ->groupBy('categories.id', 'categories.name')
                ->get();
        return [
            'categories' => $categories,
            'receipts'   => $receipts,
            'sqlTotal'   => $sqlTotal
        ];   
    }

    public function eloquent(Request $request) {
        $categories = Category::orderBy('id', 'DESC')
                ->get();

        $receipts = Receipt::select(
                    'receipts.id', 'receipts.total_price', 'receipts.quantity',
                    'receipts.note', 'receipts.delivery_date', 'receipts.type',
                    'users.email',
                    'storages.name',
                    'logistics_providers.name',
                    'categories.name'
                )
                ->join('users', 'receipts.user_id', '=', 'users.id')
                ->join('categories', 'receipts.category_id', '=', 'categories.id')
                ->join('storages', 'receipts.storage_id', '=', 'storages.id')
                ->join('logistics_providers', 'receipts.logistics_provider_id', '=', 'logistics_providers.id')
                ->where('users.created_at', '<>', 'null')
                ->orderBy('users.id', 'DESC')
                ->get();

        $relations = Category::with('receipts', 'receipts.storage', 'receipts.category')->get();
        return [
            'categories' => $categories,
            'receipts'   => $receipts,
            'relations'  => $relations
        ];
    }

}
