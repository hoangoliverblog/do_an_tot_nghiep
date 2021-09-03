@extends('user.master.notBanner')
@section('content')
<link rel="stylesheet" href="{{asset('lib/style/resgister.css')}}">
<div class="container">
<div class="card bg-light">
<article class="card-body mx-auto" style="max-width: 400px;">
	<h4 class="card-title mt-3 text-center">Tạo tài khoản</h4>
	<p class="text-center">Tạo tài khoản miễn phí ngay tại đây </p>
	<p>
        <a href="" class="btn btn-block btn-facebook" style="background-color: #d2362a"> <i></i>Google</a>
	</p>
	<p class="divider-text">
        <span class="bg-light">OR</span>
    </p>
    @if(isset($message_pass))
    {{$message_pass}}
    @endif
	<form action="{{route('user.createUser')}}" method="POST" id="login_form">
        @method('HEAD')
        @csrf
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
            </div>
            <div id="result"></div>
            <input id="name" name="name" class="form-control" placeholder="Tên tài khoản" type="text">
        </div> <!-- form-group// -->
        @error('name')
            {{$message}}
        @enderror
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
            </div>
            <input name="email" class="form-control" placeholder="Email" type="email">
        </div> <!-- form-group// -->
        @error('email')
            {{$message}}
        @enderror
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
            </div>
            <input name="phone" class="form-control" placeholder="Số điện thoại" type="text">
        </div> <!-- form-group// -->
        @error('phone')
            {{$message}}
        @enderror
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
            </div>
            <input class="form-control" name="password" placeholder="Create password" type="password">
        </div> <!-- form-group// -->
        @error('password')
            {{$message}}
        @enderror
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
            </div>
            <input class="form-control" name="re_password" placeholder="Repeat password" type="password">
        </div> <!-- form-group// -->                                      
        @error('re_password')
            {{$message}}
        @enderror
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block"> Create Account  </button>
        </div> <!-- form-group// -->      
        <p class="text-center">Bạn đã có tài khoản, xin mời<a href="{{route('user.Login')}}">Đăng nhập</a> </p>                                                                 
    </form>
</article>
@endsection
@push('scripts')
<script>
    window.onload = function()
    {
        var elmnt = document.getElementById("login_form");
        elmnt.scrollIntoView();
    };
</script>
@endpush