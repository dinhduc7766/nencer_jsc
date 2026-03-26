{{-- Xac dinh ke thua tu file master --}}
@extends("master")
@section("content")
<div id="login_box" class="card-section col-md-3">
    <h1 class="text-center">Đăng nhập</h1>
    <br>
    <form action="{{ url('login')}}" method="post" id="login_form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <label for="Email"><strong>Email</strong> <span class="text-danger">*</span></label>
        <input type="email" name="email" placeholder="Example@gmail.com" class="form-control">
        <br>
        <label for="Password"><strong>Mật khẩu</strong> <span class="text-danger">*</span></label>
        <input type="password" name="password" placeholder="" class="form-control">
        <br>
        <button type="submit" class="btn btn-primary float-right">Đăng nhập</button>
    </form>
</div>
@endsection