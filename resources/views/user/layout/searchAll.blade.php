@extends('user.master.home')
@section('content')
    <!-- ++++++++++++++++ all product ++++++++++++++++++ -->     

                <!-- *********** New product *********** -->
             
                <div class="wapper_product">
                    <div class="sale_product">
                        <span><i class="fas fa-archway"></i>Mua ngay sản phẩm chính hẵng với Shop mỹ phẩm 365</span>
                    </div>
                    <div class="title_product">
                        <h3>Danh sách sản phẩm tìm kiếm</h3>
                    </div>
                    <div class="container">
                        <div class="row">
                            @foreach ($aryResult as $item)
                                <div class="col-md-3 col-sm-12 col-xs-6 product_body">
                                    <div class="product_img" style="height: 10rem">
                                        <img src="{{asset('img')}}{{'/'.$item->img}}" alt="photo">
                                    </div>
                                    <div class="product_des">
                                        <p>{!!$item->desc!!}</p>
                                    </div>
                                    <div class="product_price">
                                        <label><del>{{$item->price ?? ''}}</del></label>
                                        @if(isset($item->sale) & $item->sale > 0)
                                            <label>{{$item->price - $item->price * $item->sale /100}}</label>
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