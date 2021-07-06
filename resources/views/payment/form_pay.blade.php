<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Thanh toán</title>
    <link rel="stylesheet" href="{{asset('payment/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('payment/jumbotron-narrow.css')}}">
    <link rel="stylesheet" href="{{asset('payment/jquery-1.11.3.min.js')}}">
    <!-- Bootstrap core CSS -->
    {{-- <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="{{ asset('css/jumbotron-narrow.css') }}" rel="stylesheet">
    <script src="{{ asset('js/jquery-1.11.3.min.js') }}"></script> --}}
</head>

<body>

    <div class="container">
        <div class="header clearfix">
            <h3 class="text-muted" style="text-align: center; color: blue">THANH TOÁN MUA SẢN PHẨM</h3>
        </div>

        {{-- <h4 style=" color: red">Vui lòng thanh toán số tiền: {{ $require->cost }} x {{ $require->time_required }}h x
            20% (VNĐ) (phí nhận lớp = 20% giá trị lớp mà bạn nhận dạy)</h4> --}}

        <div class="table-responsive">

            <form action="" id="create_form" method="post">
                @csrf
                <div class="form-group">
                    <label for="order_name">Tên người dùng</label>
                    <input class="form-control" id="order_name" name="order_name" type="text"
                        value="" readonly />
                </div>
                <div class="form-group">
                    <label for="order_id">Tên sản phẩm thanh toán</label>
                    <input class="form-control" id="order_id" name="order_id" type="text"
                        value="" readonly />
                </div>
                    <input class="form-control" id="post_id" name="post_id" 
                        value="" type="hidden"/>
                <div class="form-group">
                    <label for="amount">Số tiền (VNĐ)</label>
                    <input class="form-control" id="amount" name="amount" type="number"
                        value="" readonly />
                </div>
                <div class="form-group">
                    <label for="order_desc">Nội dung thanh toán</label>
                    <textarea class="form-control" cols="20" id="order_desc" name="order_desc" rows="2"
                        placeholder="VD: Thanh toán phí nhận lớp" required></textarea>
                </div>
                <div class="form-group">
                    <label for="bank_code">Ngân hàng</label>
                    <select name="bank_code" id="bank_code" class="form-control">
                        <option value="">Không chọn</option>
                        <option value="NCB"> Ngân hàng NCB</option>
                        <option value="AGRIBANK"> Ngân hàng Agribank</option>
                        <option value="SCB"> Ngân hàng SCB</option>
                        <option value="SACOMBANK">Ngân hàng SacomBank</option>
                        <option value="EXIMBANK"> Ngân hàng EximBank</option>
                        <option value="MSBANK"> Ngân hàng MSBANK</option>
                        <option value="NAMABANK"> Ngân hàng NamABank</option>
                        <option value="VNMART"> Vi dien tu VnMart</option>
                        <option value="VIETINBANK">Ngân hàng Vietinbank</option>
                        <option value="VIETCOMBANK"> Ngân hàng VCB</option>
                        <option value="HDBANK">Ngân hàng HDBank</option>
                        <option value="DONGABANK"> Ngân hàng Dong A</option>
                        <option value="TPBANK"> Ngân hàng TPBank</option>
                        <option value="OJB"> Ngân hàng OceanBank</option>
                        <option value="BIDV"> Ngân hàng BIDV</option>
                        <option value="TECHCOMBANK"> Ngân hàng Techcombank</option>
                        <option value="VPBANK"> Ngân hàng VPBank</option>
                        <option value="MBBANK"> Ngân hàng MBBank</option>
                        <option value="ACB"> Ngân hàng ACB</option>
                        <option value="OCB"> Ngân hàng OCB</option>
                        <option value="IVB"> Ngân hàng IVB</option>
                        <option value="VISA"> Thanh toán qua VISA/MASTER</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="language">Ngôn ngữ</label>
                    <select name="language" id="language" class="form-control">
                        <option value="vn">Tiếng Việt</option>
                        <option value="en">English</option>
                    </select>
                </div>
                <button style="color: red" type="submit" class="btn btn-default">Thanh toán Redirect</button>
            </form>
        </div>
        <p>
            &nbsp;
        </p>
        <footer class="footer">
            <p>&copy; VNPAY 2021</p>
        </footer>
    </div>
    <link href="https://sandbox.vnpayment.vn/paymentv2/lib/vnpay/vnpay.css" rel="stylesheet" />
    <script src="https://sandbox.vnpayment.vn/paymentv2/lib/vnpay/vnpay.js"></script>
    <script type="text/javascript">
        $("#btnPopup").click(function() {
            var postData = $("#create_form").serialize();
            var submitUrl = $("#create_form").attr("action");
            $.ajax({
                type: "POST",
                url: submitUrl,
                data: postData,
                dataType: 'JSON',
                success: function(x) {
                    if (x.code === '00') {
                        if (window.vnpay) {
                            vnpay.open({
                                width: 768,
                                height: 600,
                                url: x.data
                            });
                        } else {
                            location.href = x.data;
                        }
                        return false;
                    } else {
                        alert(x.Message);
                    }
                }
            });
            return false;
        });
    </script>
</body>
</html>

