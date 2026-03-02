<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

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
}
