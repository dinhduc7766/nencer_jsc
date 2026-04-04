@extends('main')
@section('content')
    <div id="content">
        <div class="col-md-12">
            <h3>Danh mục sản phẩm</h3>
            <div class="clear-fix"></div>
            <table class="table table-bordered table-hover">
                <thead>
                    <td>#</td>
                    <td>Tên danh mục</td>
                    <td>Tổng số đơn nhập</td>
                    <td>Tổng số đơn xuất</td>
                    <td>Tổng số sản phẩm</td>
                </thead>
                <tbody>
                    @foreach($categories as $category) 
                        <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->total_receipt_in_stock }}</td>
                        <td>{{ $category->total_receipt_out_stock }}</td>
                        <td>{{ $category->total_product }}</td>
                    </tr>
                    @endforeach
            </table>
        </div>
    </div>
@endsection