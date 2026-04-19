@extends('main')
@section('content')
<div id="content">
    <div class="col-md-12">
        <h3>Quản lý hoá đơn</h3>
        <div class="clear-fix"></div>
    </div>
    <div class="col-md-12">
        <form action="{{ url('/receipts/index')}}" method="get">
            <div class="row">
            <div class="col-md-3">
                <input type="text" class="form-control" name="receipt_id" placeholder="Mã hoá đơn">
            </div>
            <div class="col-md-3">
                <select name="storage_id" class="form-control" id="storages">
                    @foreach($storages as $storage)
                        <option value="{{ $storage->id }}">{{ $storage->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-control" id="status">
                    <option value="">------</option>
                    <option value="1">Đã xử lý</option>
                    <option value="0">Chưa xử lý</option>
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
            </div>
            </div>
        </form>
    </div>
    <div class="clear-fix"></div>
    <div class="col-md-12">
        <table class="table table-bodered table-hover">
            <thead class="text-center">
                <tr>
                    <td>#</td>
                    <td>Kho</td>
                    <td>Danh mục</td>
                    <td>Chi phí</td>
                    <td>Số lượng</td>
                    <td>Ghi chú</td>
                    <td>Ngày giao</td>
                    <td>Loại</td>
                    <td>Người tạo</td>
                    <td>Tên hoá đơn</td>
                    <td>Trạng thái</td>
                    <td>Thao tác</td>
                </tr>
            </thead>
            <tbody class="text-center">
                <tr>
                    @if (count($receipts) > 0)
                    @foreach ($receipts as $receipt)
                        <td>{{ $receipt->id }}</td>
                        <td>{{ $receipt->storage_name }}</td>
                        <td>{{ $receipt->category_name }}</td>
                        <td>{{ $receipt->total_price }}</td>
                        <td>{{ $receipt->quantity }}</td>
                        <td>{{ $receipt->note }}</td>
                        <td>{{ $receipt->delivery_date }}</td>
                        <td>{{ $receipt->type_txt }}</td>
                        <td>{{ $receipt->email }}</td>
                        <td>{{ $receipt->receipt_name }}</td>
                        <td>{{ $receipt->status_txt }}</td>
                        <td>
                            <a href="{{ url('receipts/detail/' . $receipt->id)}}" class="btn btn-primary">
                                Chi tiết
                            </a>
                        </td>
                    @endforeach
                    @endif
                </tr>
            </tbody>
        </table>
        {{-- phan trang --}}
        {{ $receipts->links() }}
    </div>
</div>
@endsection