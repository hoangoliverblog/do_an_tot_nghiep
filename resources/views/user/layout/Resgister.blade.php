@extends('user.master.home')
@section('content')
{{-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> --}}
{{-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> --}}
{{-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}
<!------ Include the above in your HEAD tag ---------->

{{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css"> --}}

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
<article class="card-body mx-auto" style="max-width: 400px;" id="login_form">
	<h4 class="card-title mt-3 text-center">Tạo tài khoản</h4>
	<p class="text-center">Tạo tài khoản miễn phí ngay tại đây </p>
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
	<form action="{{route('user.createUser')}}" method="POST">
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
        <p class="text-center">Bạn đã có tài khoản, xin mời<a href="">Đăng nhập</a> </p>                                                                 
    </form>
</article>
</div> <!-- card.// -->

</div> 
<!--container end.//-->

<br><br>
<article class="bg-secondary mb-3">  
<div class="card-body text-center">
    <h3 class="text-white mt-3">Bootstrap 4 UI KIT</h3>
<p class="h5 text-white">Components and templates  <br> for Ecommerce, marketplace, booking websites 
and product landing pages</p>   <br>
<p><a class="btn btn-warning" target="_blank" href="http://bootstrap-ecommerce.com/"> Bootstrap-ecommerce.com  
 <i class="fa fa-window-restore "></i></a></p>
</div>
<br><br>
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