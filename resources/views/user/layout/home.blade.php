@extends('user.master.home')
@section('content')
    <!-- ++++++++++++++++ all product ++++++++++++++++++ -->     

                <!-- *********** New product *********** -->
             
                <div class="wapper_product">
                    <div class="sale_product">
                        <span><i class="fas fa-archway"></i>Mua ngay sản phẩm chính hẵng với Shop mỹ phẩm 365</span>
                    </div>
                    <div class="title_product">
                        <h3>Sản phẩm mới</h3>
                    </div>
                    <div class="container">
                        <div class="row">
                            @foreach ($listsp as $item)
                                <div class="col-md-3 col-sm-12 col-xs-6 product_body">
                                    <div class="product_img" style="height: 10rem">
                                        <img src="{{asset('img')}}{{'/'.$item->img}}" alt="photo">
                                    </div>
                                    <div class="product_des">
                                        <p>{!!$item->desc!!}</p>
                                    </div>
                                    <div class="product_price">
                                        {{-- substr("abcdef", 0, -1) --}}
                                        <label>
                                            <del>
                                                {{-- {{$item->price ?? ''}} --}}
                                                @if ($item->price < 99999)
                                                {{$item->price/1000 . '.000'}}
                                                @else
                                                {{$item->price/1000}}
                                                @endif
                                                vnđ
                                            </del>
                                        </label>
                                        @if(isset($item->sale) & $item->sale > 0)
                                            <label>
                                                @if ($item->price - $item->price * $item->sale /100 < 99999)
                                                {{($item->price - $item->price * $item->sale /100)/1000 . '00'}}
                                                @else
                                                {{($item->price - $item->price * $item->sale /100)/1000 }}
                                                @endif
                                                vnđ
                                            </label>
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
                            <div class="product_price">
                                <label>
                                    <del>
                                        {{-- {{$item->price ?? ''}} --}}
                                        @if ($item->price < 99999)
                                        {{$item->price/1000 . '.000'}}
                                        @else
                                        {{$item->price/1000 }}
                                        @endif
                                        vnđ
                                    </del>
                                </label>
                                @if(isset($item->sale) & $item->sale > 0)
                                    <label>
                                        @if ($item->price - $item->price * $item->sale /100 < 99999)
                                        {{($item->price - $item->price * $item->sale /100)/1000 . '00'}}
                                        @else
                                        {{($item->price - $item->price * $item->sale /100)/1000 }}
                                        @endif
                                        vnđ
                                    </label>
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
                                        <label>
                                            <del>
                                                {{-- {{$item->price ?? ''}} --}}
                                                @if ($item->price < 99999)
                                                    @if($item->price % 1000 == 0)
                                                        {{$item->price/1000 .'.000'}}
                                                    @else
                                                        {{$item->price/1000 }}
                                                    @endif
                                                @else
                                                {{$item->price/1000 }}
                                                @endif
                                                vnđ
                                            </del>
                                        </label>
                                        @if(isset($item->sale) & $item->sale > 0)
                                            <label>
                                                @if ($item->price - $item->price * $item->sale /100 < 99999)
                                                    @if (($item->price - $item->price * $item->sale /100) % 1000 == 0)
                                                         {{($item->price - $item->price * $item->sale /100)/1000 . '00'}}
                                                    @else
                                                    {{($item->price - $item->price * $item->sale /100)/1000}}
                                                    @endif
                                                @else
                                                 {{($item->price - $item->price * $item->sale /100)/1000 }}
                                                @endif
                                                vnđ
                                            </label>
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