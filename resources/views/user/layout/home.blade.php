@extends('user.master.home')
@section('content')
    <!-- ++++++++++++++++ all product ++++++++++++++++++ -->     

                <!-- *********** New product *********** -->
             
                <div class="wapper_product">
                    <div class="sale_product">
                        <span><i class="fas fa-archway"></i>Mua ngay sản phẩm chính hẵng với Shop rau củ 365</span>
                    </div>
                    <div class="title_product">
                        <h3>Sản phẩm mới</h3>
                    </div>
                    <div class="container" style="background-color: #fdfbfb;">
                        <div class="row">
                            <div class="col-md-4 col-sm-12 col-xs-6 product_body">
                                <div style="height: 15rem">
                                    <img style="height:100%" src="{{asset('img')}}{{'/7_nuoc-hoa-ban-chay-nhat.png'}}" alt="photo">
                                </div>
                            </div>
                            @foreach ($listsp as $item)
                                <div class="col-md-3 col-sm-12 col-xs-6 product_body">
                                    <div class="product_img" style="height: 10rem">
                                        <img src="{{asset('img')}}{{'/'.$item->img}}" alt="photo">
                                    </div>
                                    <div class="product_des">
                                        <p>{!!$item->desc!!}</p>
                                    </div>
                                    <div class="evaluate">
                                        <h6><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>0 đánh giá</h6>
                                    </div>
                                    <div class="product_price">
                                        <label><del>{{number_format($item->price, 0, '', ',') ?? ''}}</del></label>
                                        @if(isset($item->sale) & $item->sale > 0)
                                            <label>{{number_format($item->price - $item->price * $item->sale /100,0,'',',')}} VNĐ</label>
                                        @endif 
                                    </div>
                                    <div class="product_btn">
                                    <button><a href="{{route('user.sanpham',[$item->id])}}">Mua ngay</a></button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="owl-carousel owl-theme" id="owl-carousel_product">
                    @foreach ($listsp as $item)
                    <div class="item">
                        <div class="owl-product_body">
                            <div class="product_img" style="height: 10rem">
                                <img src="{{asset('img')}}{{'/'.$item->img}}" alt="photo">
                            </div>
                            <div class="product_des">
                                <p>{!!$item->desc!!}</p>
                            </div>
                            <div class="evaluate">
                                        <h6><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>0 đánh giá</h6>
                                    </div>
                            <div class="product_price">
                                <label><del>{{number_format($item->price, 0, '', ',') ?? ''}}</del></label>
                                @if(isset($item->sale))
                                    <label>{{number_format($item->price - $item->price * $item->sale /100,0,'',',')}} VNĐ</label>
                                @endif 
                            </div>
                            <div class="product_btn">
                                <button><a href="{{route('user.sanpham',[$item->id])}}">Mua ngay</a></button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            
                <!-- *********** Top product *********** -->
                <div class="wapper_product">
                    <div class="title_product">
                        <h3>Sản phẩm giảm giá</h3>
                    </div>
                    <div class="container">
                        <div class="row">
                            @foreach ($listsp_nb as $item)
                                <div class="col-md-3 col-sm-12 col-xs-6 product_body">
                                    <div class="product_img" style="height: 10rem">
                                        <img src="{{asset('img')}}{{'/'.$item->img}}" alt="photo">
                                    </div>
                                    <div class="product_des">
                                        <p>{{$item->thongtin}}</p>
                                    </div>
                                    <div class="product_price">
                                        <label><del>{{number_format($item->price, 0, '', ',')}}</del></label>
                                        @if(isset($item->sale))
                                            <label>{{number_format($item->price - $item->price * $item->sale /100,0,'',',')}} VNĐ</label>
                                        @endif 
                                    </div>
                                    <div class="product_btn">
                                        <button><a href="{{route('user.sanpham',[$item->id])}}">Mua ngay</a></button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>   
@endsection