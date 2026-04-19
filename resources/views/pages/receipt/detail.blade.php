@extends('main')
@section('content')
<div id="content">
    <div class="col-md-12">
        <h3>Quản hoá đơn</h3>
        <div class="clear-fix"></div>
    </div>
    <!-- Begin box receipts detail -->
    <div id="receipt_detail_box" class="card-section col-md-4">
        <h3 class="text-center">Chi tiết hoá đơn</h3>
        <br>
        <form action="{{ url('/receipts/update/' . $receipt->id) }}" method="post" id="login_form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <p>Mã hoá đơn: <strong>{{ $receipt->id }}</strong></p>
            <br>
            <p>Tên hoá đơn: <span>{{ $receipt->reciept_name}}</span></p>
            <br>
            <p>Danh mục sản phẩm: {{ $receipt->category_name}}</p>
            <br>
            <p>Tổng chi phí: {{ number_format($receipt->total_price, 0)}}</p>
            <br>
            <p>Số lượng sản phẩm: <strong>{{ $receipt->quantity}}</strong></p>
            <br>
            <p>Ghi chú:</p>
            <p>{{ $receipt->note }}</p>
            <br>
            <p>Ngày giao: <strong>{{ $receipt->delivery_date }}</strong></p>
            <br>
            <p>Loại: <strong>{{ $receipt->type_txt}}</strong></p>
            <br>
            <p>Nhân viên tạo: <strong>{{ $receipt->email }}</strong></p>
            <br>
            <label for="status">Trạng thái</label>
            <select name="status" id="status" class="form-control">
                <option @if($receipt->status == 1) selected @endif value="1">Đã xử lý</option>
                <option @if($receipt->status == 0) selected @endif value="0">Chưa xử lý</option>
            </select>
            <br>
            <button type="submit" class="btn btn-primary float-right">Cập nhật</button>
            <br><br>
        </form>
    </div>
</div>
@endsection