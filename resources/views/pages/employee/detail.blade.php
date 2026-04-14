@extends('main')
@section('content')
<div id="content">
    <div class="col-md-12">
        <h3>Quản lý nhân viên: 
            <span class="txt-storage-name">{{ $employee->email }}</span>
        </h3>
        <div class="clear-fix"></div>
        <form action="{{ url('/employees/update/' . $employee->id) }}" method="post" id="employee_edit_form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row">
                <div class="col-md-3">
                    <label for="storage">Kho phụ trách <span class="text-danger">*</span></label>
                    <select name="storage" id="storage" class="form-control">
                        @foreach($storages as $storage)
                            <option @if($storage->id == $employee->storage_id) selected @endif value="{{ $storage->id }}">
                                {{ $storage->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="password">Mật khẩu <span class="text-danger">*</span></label>
                    <input type="password" required class="form-control" name="password" value="12345678">
                </div>
                <div class="col-md-3">
                    <br>
                    <button class="btn btn-primary">Chỉnh sửa</button>
                </div>
            </div>
        </form>
        <div class="clear-fix"></div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2">
                    <p>Đơn hàng của nhân viên.</p>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <table class="table table-bodered table-hover">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>Tên đơn hàng</td>
                        <td>Danh mục đơn hàng</td>
                        <td>Số lượng sản phẩm</td>
                        <td>Ngày giao hàng</td>
                        <td>Tình trạng xử lý</td>
                    </tr>
                </thead>
                <tbody>
                    @if(count($receipts) > 0)
                    @foreach($receipts as $receipt)
                    <tr>
                        <form id="form_update_receipt_{{ $receipt->id }}" action="{{ url('/receipts/update/' . $receipt->id) }}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <td>{{ $receipt->id }}</td>
                            <td>{{ $receipt->receipt_name }}</td>
                            <td>{{ $receipt->category_name }}</td>
                            <td>{{ $receipt->quantity }}</td>
                            <td>{{ $receipt->delivery_date }}</td>
                            <td>
                                <select name="status" class="form-control" id="status" onchange="updateReceipt({{ $receipt->id }})">
                                    <option @if($receipt->status == 0) selected @endif value="0">Chưa xử lý</option>
                                    <option @if($receipt->status == 1) selected @endif value="1">Đã xử lý</option>
                                </select>
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

@section('custom-js')
<script>
    // JS method send form update receipt to server.
    function updateReceipt(receiptId) {
        $('#form_update_receipt_' + receiptId).submit();
    }
</script>
@endsection