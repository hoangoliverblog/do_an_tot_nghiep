@extends('user.master.notBanner')
@section('content')
{{-- <link rel="stylesheet" href="{{asset('lib/style/styleshowproduct.css')}}"> --}}
<link rel="stylesheet" href="{{asset('lib/style/comment.css')}}">
<style>
 
</style>
    <!--phần của trang sản phẩm-->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-3 content-left">
                    <div class="content-left-title">
                        <h6>Dưỡng da</h6>
                    </div>
                    <div class="content-left-item">
                        <ul>
                            <li>
                                <span><i class="fas fa-angle-right"></i></span>
                                <a href="">Tẩy trang</a>
                            </li>
                            <li>
                                <span><i class="fas fa-angle-right"></i></span>
                                <a href="">Sữa rửa mặt</a>
                            </li>
                            <li>
                                <span><i class="fas fa-angle-right"></i></span>
                                <a href="">Tẩy tế bào chết</a>
                            </li>
                        </ul>
                    </div>
                    <div class="Content-left">
                    	<div class="content-left-title">
	                        <h6>Hàng mới về</h6>
	                    </div>
	                    <div class="COntent-left">
	                    	<div class="CONtent-left">
	                    		<img src="{{asset('img/1623332171_nuoc-hoa-ban-chay-nhat.png')}}">
	                    	</div>
	                    	<div class="CONTent-left">
	                    		<p>Tinh Chất Dưỡng Da Chiết Xuất Trà Xanh Innisfree Green Tea</p>
	                    		<h6>Seed Serum 30ml</h6>
	                    		<h6 class="gia"><del>349.000đ</del>245.000đ</h6>
	                    	</div>
	                    </div>
                    </div>
                </div>
                <div class="col-md-9 content-right">
                    <div class="content-right-title">
                        <h6 class="Content-right-title">Thông tin chi tiết về sản phẩm</h6>
                    </div>
                    <div class="Banner-my-pham">
                        <img src="{{asset('img')}}{{'/'.$product->img}}">
                    </div>
                    @if (\Session::has('msg'))
                    <div class="alert alert-success">
                        <ul>
                            <li>{!! \Session::get('msg') !!}</li>
                        </ul>
                    </div>
                     @endif
                    <div class="row">
                    	<div class="col-md-12 sp-my-pham-nhat">
                        <form action="{{route('user.buyProduct',['id'=>$product->id])}}" method="POST">
                          @csrf
                          @method('HEAD')
	                    	  <div class="NEW-Sanpham">
                            <h3>{{$product->name}}</h3>
                            <h4>
                              <del>{{$product->price}}</del>
                              @if(isset($product->sale))
                                {{$product->price - $product->price * $product->sale /100}}  
                                <span>Giảm 55%, tiết kiệm</span>
                              @endif
                            </h4>
                            <p>{{$product->thongtin}}</p> 
                            @if (!isset($user->email))
                                <div class="form-row">
                                  <div class="form-group col-md-6">
                                    <label for="inputEmail4" style="float: left;">Email</label>
                                    <input type="email" class="form-control" id="inputEmail4" name="email">
                                  </div>
                                  <div class="form-group col-md-6">
                                    <label for="inputPassword4" style="float: left;">Số điện thoại</label>
                                    <input type="text" class="form-control" id="inputPassword4" name="phone">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="inputAddress" style="float: left;">Địa chỉ</label>
                                  <input type="text" class="form-control" id="inputAddress" name="address">
                                </div>
                                <div class="form-row">
                                  <div class="form-group col-md-6">
                                    <label for="inputCity" style="float: left;">Thành phố</label>
                                    <input type="text" class="form-control" id="inputCity" name="city">
                                  </div>
                                  <div class="form-group col-md-2">
                                    <label for="inputZip">Mã bưu điện</label>
                                    <input type="text" class="form-control" id="inputZip" name="zipcode">
                                  </div>
                                </div>
                            @endif                               
                            <div>
                                <h4>Số lượng</h4>
                                <span class="minus" id="minus">-</span>
                                <input type="text" name="soluong" id="soluong" value="3" readonly>
                                <span class="sum" id="sum">+</span>
                            </div>
                            <div>
                                <button class="btn-add" type="submit">Chọn mua sản phẩm</button>
                            </div>
			    		            </div>                    
                        </form>
	                    </div>
                    </div>
                </div>
            </div>
            <div>
              
            </div>
        </div>
    </div>
    <!--++++++++++++++++++End-Content+++++++++++++++++++++++-->

@endsection
@push('scripts')
<script>
  a = document.getElementById('soluong').value;
  console.log(a);
</script>
@endpush

