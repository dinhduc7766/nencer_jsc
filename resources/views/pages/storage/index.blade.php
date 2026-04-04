@extends('main')
@section('content')
    <div id="content">
        <div class="col-md-12">
            <h3>Quản lý kho</h3>
            <a class="btn btn-primary float-right" href="{{ url('/storages/create') }}">Thêm mới</a>
            <div class="clear-fix"></div>
            <table class="table table-bordered table-hover">
                <thead>
                    <td>#</td>
                    <td>Tên kho</td>
                    <td>Phí duy trì</td>
                    <td>Tổng đơn hàng trong kho</td>
                    <td>Thao tác</td>
                </thead>
                <tbody>
                    @foreach($storages as $storage)
                    <tr>
                        <td>{{ $storage->id }}</td>
                        <td>{{ $storage->name }}</td>
                        <td>{{ number_format($storage->cost, 0) }}</td>
                        <td>{{ $storage->total }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{ url('/storages/edit/' . $storage->id) }}">Chi tiết</a>
                            <a class="btn btn-danger" href="{{ url('/storages/delete/' . $storage->id) }}">Xoá</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection