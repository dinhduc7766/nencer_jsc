@extends('main')
@section('content')
<div id="content">
        <div class="col-md-12">
            <h3>Quản lý nhân viên</h3>
            <div class="clear-fix"></div>
            <a class="btn btn-primary float-right" href="{{ url('employees/create')}}">Thêm mới</a>
            <br/><br/>
            <table class="table table-bordered table-hover">
                <thead>
                    <td>#</td>
                    <td>Email</td>
                    <td>Kho phụ trách</td>
                    <td>Tổng số đơn hàng của nhân viên</td>
                    <td>Thao tác</td>
                </thead>
                <tbody>
                    @foreach($employees as $employee)
                        <tr>
                        <td>{{ $employee->id }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->total_receipt }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{ url('/employees/detail/' . $employee->id) }}">Chi tiết</a>
                            <a class="btn btn-danger" href="{{ url('/employees/delete/' . $employee->id) }}">Nghỉ việc</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection