<?php

namespace App\Http\Controllers;

use App\Models\Storage;
use App\Models\Receipt;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;
use Symfony\Component\HttpKernel\HttpCache\Store;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $employees = User::select(
            'users.id', 'users.email',
            'storages.name',
            DB::raw('COUNT(receipts.user_id) as total_receipt')
        )->join(
            'storages', 'users.storage_id', 'storages.id'
        )->leftJoin('receipts', 'receipts.user_id', 'users.id')
        ->where('users.role', 0) // Lay ra employee
        ->whereNull('users.deleted_at')
        ->groupBy('users.id', 'users.email', 'storages.name')
        ->get(); 
        return view('pages.employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get all storages.
        $storages = Storage::whereNull('storages.deleted_at')
            ->get();
        return view('pages.employee.create', compact('storages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $param = $request->all();
        $user = new User();
        $user->email = $param['email'];
        $user->password = $param['password'];
        $user->role = User::ROLE_EMPLOYEE;
        $user->storage_id = $param['storages'];
        $user->save();
        return redirect('/employees/index');
    }

    /**
     * Display the specified resource.
     */
    public function detail(string $id)
    {
        $employee = User::find($id);
        $storages = Storage::all();
        $receipts = Receipt::join(
            'categories', 'receipts.category_id', 'categories.id'
        )
        ->select(
            'receipts.id', 'receipts.name as receipt_name',
            'categories.name as category_name',
            'receipts.quantity', 'receipts.delivery_date',
            'receipts.status'
        )
        ->where('user_id', $id)
        ->orderBy('status', 'ASC')
        ->paginate(30);
        return view('pages.employee.detail', compact('employee', 'storages', 'receipts'));
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
        $param = $request->all();
        $user = User::find($id);
        $user->storage_id = $param['storage'];
        $user->password = $param['password'];
        $user->update();
        return redirect('/employees/detail/' . $id);
    }

    public function delete($id) {
        $user = User::find($id);
        $user->deleted_at = date('Y-m-d h:i:s');
        $user->update();
        return redirect('/employees/index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
