@extends('user.master.notBanner')
@section('content')
<link rel="stylesheet" href="{{asset('lib/style/styleshowproduct.css')}}">
<link rel="stylesheet" href="{{asset('lib/style/sanpham.css')}}">

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
                                <a href="">Rau củ</a>
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
                    <div class="row" style="width:50%;float:left;margin-top: 3rem;">
                    	<div class="col-md-12 sp-my-pham-nhat">
                        <form action="{{route('user.addToCart',['id'=>$product->id])}}" method="POST">
                          @csrf
                          @method('HEAD')
	                    	  <div class="NEW-Sanpham">
                            <h3>{{$product->name}}</h3>
                            <h4>Giá bán: 
                              <label style="color: red;font-size:23px">@if(isset($product->sale) & $product->sale > 0)
                                {{number_format($product->price - $product->price * $product->sale /100, 0, '', ',')}} VNĐ
                              @endif</label>
                            </h4>
                            <h4>Trạng thái: 
                              @if(isset($product->soluong) & $product->soluong > 0)
                                còn hàng
                              @else
                                hết hàng
                              @endif
                            </h4>
                            <div class="evaluate">
                                <h6><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>0 đánh giá</h6>
                            </div>
                            <p>{!!$product->thongtin!!}</p>
                            <p>{!!$product->desc!!}</p>
                            <input type="hidden" name="soluong" value="1"  readonly>
                            {{-- <div>
                                <span class="minus" id="minus">-</span>
                                <input type="hidden" name="soluong" value="1"  readonly>
                                <span class="sum" id="sum">+</span>
                            </div> --}}
                            <div>
                                <button class="btn-add" type="submit">Thêm vào giỏ</button>
                                <a href="{{route('user.showBuy',['id'=>$product->id])}}" class="btn-buy">Chọn mua</a>
                            </div>
                            <h3 style="margin: 7rem 0 0 0;">Nguồn gốc sản phẩm</h3>
                            <div style="color: #928f8f; font-size : 15px">
                                <label>Danh mục:         <span>Củ quả hữu cơ</span></label>
                                <label>Xuất xứ:          <span>Hợp tác xã nông sản sạch</span></label>
                                <label>Email liên hệ:    <span>support@gmail.com</span></label>
                                <label>Phone:            <span>19008198</span></label>
                            </div>
			    		        	  </div>                    
                        </form>
	                    </div>
                    </div>
                </div>
                <div style="padding-left:1rem">
                    <h4>Thêm thông số về sản phẩm :</h4>
                    <h5>Mã sản phẩm :{{$product->id}}</h5>
                    <h5>Lượt xem :</h5>
                    <h5>Nhà sản xuất :</h5>
                    <h5>Tình trạng : @if ($product->soluong > 0)
                        <span>Còn hàng</span>    
                        @else
                        <span>Hết hàng</span>                            
                    @endif</h5>
                </div>
            </div>
            <div>
              <div class="comments-app" ng-app="commentsApp" ng-controller="CommentsController as cmntCtrl">
                <h1>Bình luận của khách hàng</h1>
                
                <!-- From -->
                <div class="comment-form">
                  <!-- Comment Avatar -->
                  <div class="comment-avatar">
                    <img src="{{asset('img/1623332171_nuoc-hoa-ban-chay-nhat.png')}}">
                  </div>
              
                  <form class="form" action="{{route('user.comment',['id'=>$product->id])}}" method="POST" name="form" ng-submit="form.$valid && cmntCtrl.addComment()" novalidate>
                    @csrf
                    @method('HEAD')
                    <div class="form-row">
                      <textarea 
                                name="comment"
                                class="input"
                                ng-model="cmntCtrl.comment.text"
                                placeholder="Viết bình luận..."
                                required></textarea>
                    </div>
                    @error('comment')
                          {{$message}}
                        @enderror
                    @if (!Auth::check())
                    <div class="form-row">
                      <input
                             class="input"
                             ng-class="{ disabled: cmntCtrl.comment.anonymous }"
                             ng-disabled="cmntCtrl.comment.anonymous"
                             ng-model="cmntCtrl.comment.author"
                             ng-required="!cmntCtrl.comment.anonymous"
                             placeholder="Email"
                             type="email"
                             name="email"
                             >
                    </div>
                    @error('email')
                          {{$message}}
                        @enderror
                    @endif
                    <div class="form-row">
                      <input type="submit" value="Bình luận">
                    </div>
                  </form>
                </div>
              
                <!-- Comments List -->
                <div class="comments">
                  <!-- Comment -->
                  <div class="comment" ng-repeat="comment in cmntCtrl.comments | orderBy: '-date'">
                    <!-- Comment Avatar -->
                    <div class="comment-avatar">
                      <img ng-src="">
                    </div>
                  {{--               
                    <!-- Comment Box -->
                    <div class="comment-box">
                      <div class="comment-text"></div>
                      <div class="comment-footer">
                        <div class="comment-info">
                          <span class="comment-author">
                            <em ng-if="comment.anonymous">Anonymous</em>
                            <a ng-if="!comment.anonymous" href=""></a>
                          </span>
                          <span class="comment-date"></span>
                        </div>
              
                        <div class="comment-actions">
                          <a href="#">Reply</a>
                        </div>
                      </div>
                    </div>
                  </div>
               --}}
                  <!-- Comment - Dummy -->
                  <div class="comment">
                    <!-- Comment Avatar -->
                    <div class="comment-avatar">
                      <img src="http://gravatar.com/avatar/412c0b0ec99008245d902e6ed0b264ee?s=80">
                    </div>
                    
                    <!-- Comment Box -->
                    @foreach ($comment as $item)
                    <div class="comment-box">
                      <div class="comment-text">{{$item->content}}</div>
                      <div class="comment-footer">
                        <div class="comment-info">
                          <span class="comment-author">
                            <a href="">{{$item->user->name ?? 'Anonymous'}}</a>
                          </span>
                          <span class="comment-date">{{$item->user->email ?? $item->emailIfNotLogin}}</span>
                        </div>
                        <div class="comment-actions">
                          <a href="#">{{$item->created_at}}</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach
                  <!-- Comment - Dummy -->
                  <div class="comment">
                  </div>
                </div>
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

