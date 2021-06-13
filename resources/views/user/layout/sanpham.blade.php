@extends('user.master.notBanner')
@section('content')
<link rel="stylesheet" href="{{asset('lib/style/styleshowproduct.css')}}">
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
                        <img src="{{asset('img/1623332171_nuoc-hoa-ban-chay-nhat.png')}}">
                    </div>
                    <div class="row">
                    	<div class="col-md-12 sp-my-pham-nhat">
	                    	<div class="NEW-Sanpham">
                                <h6><i class="far fa-star"></i>0 đánh giá/Bài viết</h6>
			    				<h3>{{$product->name}}</h3>
                                <h4><del>{{$product->price}}</del>{{$product->price - $product->price * $product->sale /100}}<span>Giảm 55%, tiết kiệm</span></h4>
                                <p>{{$product->thongtin}}</p>
                                <p>{{$product->desc}}</p>
                                <div>
                                    <span class="minus" id="minus">-</span>
                                    <input type="text" name="soluong" value="1">
                                    <span class="sum" id="sum" onclick="sum()">+</span>
                                </div>
                                <div>
                                    <button class="btn-add">Thêm vào giỏ</button>
                                    <button class="btn-buy">Mua ngay</button>
                                </div>
			    			</div>
	                    </div>
                    </div>
                </div>
                <div>
                    <h4>Thêm thông số về sản phẩm :</h4>
                    <h5>Mã sản phẩm :</h5>
                    <h5>Lượt xem :</h5>
                    <h5>Nhà sản xuất :</h5>
                    <h5>Tình trạng :</h5>
                </div>
            </div>
        </div>
    </div>
    <!--++++++++++++++++++End-Content+++++++++++++++++++++++-->

@endsection
@push('scripts')
<script>
    
    
    
</script>
@endpush

