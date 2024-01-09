@extends('admin.master.dashboard')
@section('main_content')
<div class="container">
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-4" style="background-color: gray;height:10rem;border-radius:10px;margin:3rem 1rem">
      <div style="text-align:center;color:white">
        <h3>Tổng quan người dùng</h3>
      </div>
      <div style="text-align:left;color:white">
        <label for="">Số lượng user :</label>
        <label for="">10</label> 
      </div>
      <div style="text-align:left;color:white">
        <label for="">Tài khoản chưa kích hoạt :</label>
        <label for="">10</label>
      </div>
      <div style="text-align:left;color:white">
        <label for="">Thêm mới trong tháng :</label>
        <label for="">10</label>
      </div>
    </div>
    <div class="col-md-4" style="background-color: #2d7d6f;height:10rem;border-radius:10px;margin:3rem 1rem">
      <div style="text-align:center;color:white">
        <h3>Tổng quan giỏ hàng</h3>
      </div>
      <div style="text-align:left;color:white">
        <label for="">Loại sản phẩm được yêu thích :</label>
        <label for="">nước hoa</label> 
      </div>
      <div style="text-align:left;color:white">
        <label for="">Số sản phẩm chưa được thanh toán:</label>
        <label for="">10</label>
      </div>
      <div style="text-align:left;color:white">
        <label for="">Sản phẩm của tháng:</label>
        <label for="">san pham 1</label>
      </div>
    </div>
    <div class="col-md-3" style="background-color: #3dce23;height:10rem;border-radius:10px;margin:3rem 1rem">
      <div style="text-align:center;color:white">
        <h3>Doanh thu</h3>
      </div>
      <div style="text-align:left;color:white">
        <h2 style="display:inline-block">Tổng doanh thu :</h2>
        <label for="">10000</label> 
      </div>
      <div style="text-align:left;color:white">
        <label for="">Số đơn hàng còn chưa thanh toán:</label>
        <label for="">10</label>
      </div>
      <div style="text-align:left;color:white">
        <label for="">Số lượng đã bán trong tháng:</label>
        <label for="">100</label>
      </div>
    </div>
    <div class="col-md-3" style="background-color: #dd35d5;height:10rem;border-radius:10px;margin:3rem 1rem">
      <div style="text-align:center;color:white">
        <h3>Đánh giá sản phẩm</h3>
      </div>
      <div style="text-align:left;color:white">
        <h2 style="display:inline-block">Cao nhất:</h2>
        <label for="">nước hoa</label> 
      </div>
      <div style="text-align:left;color:white">
        <label for="">Thấp nhất:</label>
        <label for="">rau củ</label>
      </div>
    </div>
    <div class="col-md-3" style="background-color: #3a26e9;height:10rem;border-radius:10px;margin:3rem 1rem">
      <div style="text-align:center;color:white">
        <h3 style="font-size: 24px">Bình luận khách hàng</h3>
      </div>
      <div style="text-align:left;color:white">
        <label style="font-size: 20px" for="">Tổng bình luận :</label>
        <label for="">100</label> 
      </div>
      <div style="text-align:left;color:white">
        <label for="">Số lượng đánh giá tốt trong tháng:</label>
        <label for="">50</label>
      </div>
    </div>
  </div>
</div>
@endsection