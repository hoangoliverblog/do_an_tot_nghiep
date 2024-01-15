@extends('user.master.notBanner')
@section('content')
<link rel="stylesheet" href="{{asset('lib/style/resgister.css')}}">
<div class="container">
<div class="card bg-light">
<article class="card-body mx-auto" style="max-width: 400px;">
	<h4 class="card-title mt-3 text-center">Đặt lại mật khẩu</h4>
	<p>
		<a href="" class="btn btn-block btn-twitter"> <i class="fab fa-twitter"></i>google</a>
		<a href="" class="btn btn-block btn-facebook"> <i class="fab fa-facebook-f"></i>Facebook</a>
	</p>
	<p class="divider-text">
        <span class="bg-light">OR</span>
    </p>
    @if(isset($message_pass))
    {{$message_pass}}
    @endif
	<form action="{{route('user.forgotPassword', ['XDEBUG_SESSION' => 1])}}" method="POST" id="login_form">
        @method('HEAD')
        @csrf
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
            <button type="submit" class="btn btn-primary btn-block"> Đặt lại mật khẩu  </button>
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