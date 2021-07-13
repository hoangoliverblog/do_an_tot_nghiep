<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Quản trị</title>

    <!-- Bootstrap -->
    <link href="{{asset('vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
  <link href="{{asset('vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{asset('vendors/animate.css/animate.min.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{asset('build/css/custom.min.css')}}" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            @if (\Session::has('msg'))
            <div class="alert alert-success">
                <h4>{!! \Session::get('msg') !!}</h4>
            </div>
             @endif
            <form action="{{route('Admin.checkOtpGetPassword')}}" method="post">
              @csrf
              <h1>Nhập mã Otp</h1>
              <h4>Một email mới vừa được gửi tới gmail của bạn!</h4>
              @error('otp')
                  {{$message}}
              @enderror
              <div>
                <input name="otp" type="text" class="form-control" placeholder="Nhập Otp" />
              </div>
              <div>
                <button type="submit" class="btn btn-default submit">Xác nhận</button>
                <a class="reset_pass" href="{{route('Admin.showPasswordRetrieval')}}"><- Quay lại </a>
              </div>
              <div class="clearfix"></div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
