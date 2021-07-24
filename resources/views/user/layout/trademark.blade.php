@extends('user.master.notBanner')
@section('content')
    <!-- ++++++++++++++++ all product ++++++++++++++++++ -->     

                <!-- *********** New product *********** -->
                
                <div class="wapper_product">
                    <div class="sale_product">
                        <span><i class="fas fa-archway"></i>Mua ngay sản phẩm chính hẵng với Shop mỹ phẩm 365</span>
                    </div>
                    <div class="title_product">
                        <h3>Thương hiệu mỹ phẩm nổi tiếng</h3>
                    </div>
                    <div class="container">
                        <div class="row">
                            @foreach ($aryProduct as $item)
                                <div class="col-md-3 col-sm-12 col-xs-6 product_body">
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
                                                {{$item->price/1000}}
                                                @endif
                                            </del>
                                        </label>
                                        @if(isset($item->sale) & $item->sale > 0)
                                            <label>
                                                @if ($item->price - $item->price * $item->sale /100 < 99999)
                                                {{($item->price - $item->price * $item->sale /100)/1000 . '00'}}
                                                @else
                                                {{($item->price - $item->price * $item->sale /100)/1000 }}
                                                @endif
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
                <div style="text-align:center;margin: 2rem auto"><button type="button" class="btn btn-light"><span>{{$aryProduct->links()}}</span></button></div>
@endsection