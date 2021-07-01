@extends('user.master.notBanner')
@section('content')
<link rel="stylesheet" href="{{asset('lib/style/codeOtp.css')}}">
<div class="container">
<div class="card bg-light">
<article class="card-body mx-auto" style="max-width: 400px;">
	<h4 class="card-title mt-3 text-center">Nhập mã kích hoạt gồm 6 chữ số ở đây</h4>
    @if(isset($message_pass))
    {{$message_pass}}
    @endif
	<form action="{{route('user.activeAcount')}}" method="POST" id="login_form">
        @method('HEAD')
        @csrf
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"></span>
            </div>
            <input id="otp" name="otp" class="form-control" placeholder="Mã kích hoạt" type="text">
        </div> <!-- form-group// -->
        @error('otp')
            {{$message}}
        @enderror
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Xác nhận</button>
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