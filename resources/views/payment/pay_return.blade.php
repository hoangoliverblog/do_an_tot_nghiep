@php
    ob_start();
    session_start();
    $info = explode('/' , $_GET['vnp_OrderInfo']);
    $d = $_GET['vnp_PayDate'];
    $date = substr($d, 0, 4) .'-'. substr($d, 4,2) .'-'. substr($d,6,2) .' '. substr($d,8,2) .':'. substr($d,10,2) .':'. substr($d,12,2);
    $ary = $_GET['vnp_TxnRef'];
    $aryContent = explode('@',$ary);
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Thông tin thanh toán</title>
    <!-- Bootstrap core CSS -->
    <link href="{{asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="{{asset('css/jumbotron-narrow.css') }}" rel="stylesheet">
    <script src="{{ asset('js/jquery-1.11.3.min.js') }}"></script>
</head>

<body>      
    <!--Begin display -->
    <div class="container">
        <div class="header clearfix">
            <h3 class="text-muted">Thông tin đơn hàng</h3>
        </div>
        <div class="table-responsive">
            <div class="form-group">
                <label>Tên sản phẩm thanh toán :</label>
                <label> {{$aryContent[0]}} </label>
            </div>
            <div class="form-group">
                <label>Số tiền:</label>
                <label>{{number_format($_GET['vnp_Amount']/100)}} VNĐ</label>
            </div>
            <div class="form-group">
                <label>Nội dung thanh toán:</label>
                <label>{{$info[0]}}  </label>
            </div>
            <div class="form-group">
                <label>Mã GD Tại VNPAY:</label>
                <label>{{ $_GET['vnp_TransactionNo'] }}</label>
            </div>
            <div class="form-group">
                <label>Mã Ngân hàng:</label>
                <label>{{$_GET['vnp_BankCode']}} </label>
            </div>
            <div class="form-group">
                <label>Thời gian thanh toán:</label>
                <label>{{$date}}</label>
            </div>
            <div class="form-group">
                <label>Kết quả:</label>
                <label>                   
                    @if ($_GET['vnp_ResponseCode'] == '00')
                        Giao dịch thành công!                      
                    @endif
                </label>
                <br>
                <a href="{{asset('/')}}">
                    <button>Trang chủ</button>
                </a>
            </div>
        </div>
        <p>
            &nbsp;
        </p>
    </div>
</body>

</html>