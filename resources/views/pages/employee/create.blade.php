@extends('main')
@section('content')
<div id="content">
    <div class="col-md-12">
        <div id="create_employee_box" class="card-section col-md-3">
            <h3 class="text-center">Thêm mới nhân viên</h3>
            <br>
            <form action="{{ url('/employees/store')}}" method="post" id="employee_create_form">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <label for="storages"><strong>Kho phụ trách</strong> <span class="text-danger">*</span></label>
                <select name="storages" id="storages" class="form-control">
                    @foreach($storages as $storage) 
                        <option value="{{ $storage->id }}">{{ $storage->name }}</option>
                    @endforeach
                </select>
                <br>
                <label for="Email"><strong>Email</strong> <span class="text-danger">*</span></label>
                <input type="email" name="email" placeholder="Example@gmail.com" class="form-control">
                <br>
                <label for="Password"><strong>Mật khẩu</strong> <span class="text-danger">*</span></label>
                <input type="password" name="password" placeholder="" class="form-control">
                <br>
                <a href="employee_manage.html" class="btn btn-secondary">Đóng</a>
                <button type="submit" class="btn btn-primary float-right">Tạo mới</button>
                <br><br><br>
            </form>
        </div>
    </div>
</div>
@endsection