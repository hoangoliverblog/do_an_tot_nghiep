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
        <h4 class="card-title mt-3 text-center">Đăng nhập</h4>
        <p>
            <a href="" class="btn btn-block btn-twitter"> <i class="fab fa-twitter"></i>google</a>
            <a href="" class="btn btn-block btn-facebook"> <i class="fab fa-facebook-f"></i>Facebook</a>
        </p>
        <p class="divider-text">
            <span class="bg-light">OR</span>
        </p>
        @if(isset($thongbao))
        {{$thongbao}}
        @endif
        <form action="{{route('user.checkLogin')}}" method="POST" >
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
                <input class="form-control" name="password" placeholder="Enter password" type="password">
            </div> <!-- form-group// -->
            @error('password')
                {{$message}}
            @enderror
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Đăng nhập </button>
            </div> <!-- form-group// -->      
            <p class="text-center">Bạn chưa có tài khoản, xin mời<a href="{{route('user.Resgister')}}">Tạo tài khoản</a> </p>                                                                 
        </form>
    </article id="login_form" >
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
	