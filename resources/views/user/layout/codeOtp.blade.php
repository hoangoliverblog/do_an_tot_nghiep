@extends('user.master.notBanner')
@section('content')
<style>
.divider-text {
    position: relative;
    text-align: center;
    margin-top: 15px;
    margin-bottom: 15px;
}
.divider-text span {
    padding: 7px;
    font-size: 12px;
    position: relative;   
    z-index: 2;
}
.divider-text:after {
    content: "";
    position: absolute;
    width: 100%;
    border-bottom: 1px solid #ddd;
    top: 55%;
    left: 0;
    z-index: 1;
}

.btn-facebook {
    background-color: #405D9D;
    color: #fff;
}
.btn-twitter {
    background-color: #42AEEC;
    color: #fff;
}

</style>

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