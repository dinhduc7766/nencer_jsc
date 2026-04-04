@extends('main')
@section('content')
    <div id="content">
        <div class="col-md-12">
            <h3>Quản lý kho: 
                <span class="txt-storage-name">Kho ở Ngọc Trục</span>
            </h3>
            <div class="clear-fix"></div>
            <form action="{{ url('/storages/update/' . $storage->id) }}" method="post" id="storage-form">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row">
                    <div class="col-md-3">
                        <label for="storage-name">Tên kho <span class="text-danger">*</span></label>
                        <input type="text" required class="form-control" name="name" value="{{ $storage->name }}">
                    </div>
                    <div class="col-md-3">
                        <label for="cost">Phí duy trì <span class="text-danger">*</span></label>
                        <input type="number" required class="form-control" name="cost" value="{{ $storage->cost }}" min="1">
                    </div>
                    <div class="col-md-3">
                        <br>
                        <button class="btn btn-primary">Chỉnh sửa</button>
                    </div>
                </div>
            </form>
            <div class="col-md-12">
                <h4>Tổng số đơn hàng đã xử lý: <strong>{{ $totalReceipted }}</strong></h4>
            </div>
            <div class="clear-fix"></div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-2">
                        <p>Các đơn hàng trong kho</p>
                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-4">
                        <form action="" method="get">
                            <div class="row">
                                <div class="col-md-8">
                                    <input type="date" class="form-control" name="date">
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-primary">Xuất đơn hàng</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <table class="table table-bodered table-hover">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>Tên đơn hàng</td>
                            <td>Danh mục</td>
                            <td>Tổng chi phí(VND)</td>
                            <td>Số sản phẩm</td>
                            <td>Ngày giao</td>
                            <td>Ghi chú</td>
                            <td>Loại</td>
                            <td>Trạng thái</td>
                            <td>Thao tác</td>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($receipts) > 0) 
                        @foreach($receipts as $receipt)
                        <tr>
                            <form action="{{ url('/receipts/edit/' . $receipt->id) }}" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <td>{{ $receipt->id }}</td>
                            <td>{{ $receipt->name }}</td>
                            <td>{{ $receipt->category_name }}</td>
                            <td>{{ number_format($receipt->total_price, 0) }}(VND)</td>
                            <td>{{ $receipt->quantity }}</td>
                            <td>{{ $receipt->delivery_date }}</td>
                            <td>{{ $receipt->note }}</td>
                            <td>{{ $receipt->type_txt }}</td>
                            <td>
                                <select name="status" class="form-control" id="">
                                    <option @if ($receipt->status == 0) selected @endif value="0">Chưa xử lý</option>
                                    <option @if ($receipt->status == 1) selected @endif value="1">Đã xử lý</option>
                                </select>
                            </td>
                            <td>
                                <button class="btn btn-primary">Cập nhật</button>
                            </td>
                            </form>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection