@extends('user.master.notBanner')
@section('content')
<link rel="stylesheet" href="{{asset('lib/style/styleshowproduct.css')}}">
<style>
    * {
  box-sizing: border-box;
  margin: 0;
  padding: 0;

  -webkit-box-sizing: border-box;
 	-moz-box-sizing: border-box;
}

body{
  /* background-color: #dee1e3; */
  font-family: "Roboto", "Tahoma", "Arial", sans-serif;,
}

.text-right{ text-align: right; }

.comments-app{
  margin: 50px auto;
  max-width: 680px;
  padding: 0 50px;
  width: 100%;
}

.comments-app h1{
  /* color: #191919; */
  margin-bottom: 1.5em;
  text-align: center;
  text-shadow: 0 0 2px rgba(152, 152, 152, 1);
}

.comment-form{  }
.comment-form .comment-avatar{  }

.comment-form .form{ margin-left: 100px; }

.comment-form .form .form-row{ margin-bottom: 10px; }
.comment-form .form .form-row:last-child{ margin-bottom: 0; }

.comment-form .form .input{
  background-color: #fcfcfc;
  border: none;
  border-radius: 4px;
  box-shadow: 0 1px 1px rgba(0, 0, 0, .15);
  color: #555f77;
  font-family: inherit;
  font-size: 14px;
  padding: 5px 10px;
  outline: none;
  width: 100%;

  -webkit-transition: 350ms box-shadow;
  -moz-transition: 350ms box-shadow;
  -ms-transition: 350ms box-shadow;
  -o-transition: 350ms box-shadow;
  transition: 350ms box-shadow;
}

.comment-form .form textarea.input{
  height: 100px;
  padding: 15px;
}

.comment-form .form label{
  color: #555f77;
  font-family: inherit;
  font-size: 14px;
}

.comment-form .form input[type=submit]{
  background-color: #555f77;
  border: none;
  border-radius: 4px;
  box-shadow: 0 1px 1px rgba(0, 0, 0, .15);
  color: #fff;
  cursor: pointer;
  display: block;
  margin-left: auto;
  outline: none;
  padding: 6px 15px;

  -webkit-transition: 350ms box-shadow;
  -moz-transition: 350ms box-shadow;
  -ms-transition: 350ms box-shadow;
  -o-transition: 350ms box-shadow;
  transition: 350ms box-shadow;
}

.comment-form .form .input:focus,
.comment-form .form input[type=submit]:focus,
.comment-form .form input[type=submit]:hover{
  box-shadow: 0 2px 6px rgba(121, 137, 148, .55);
}

.comment-form .form.ng-submitted .input.ng-invalid,
.comment-form .form .input.ng-dirty.ng-invalid{
  box-shadow: 0 2px 6px rgba(212, 47, 47, .55) !important;
}

.comment-form .form .input.disabled {
    background-color: #E8E8E8;
}


.comments{  }

.comment-form,
.comment{
  margin-bottom: 20px;
  position: relative;
  z-index: 0;
}

.comment-form .comment-avatar,
.comment .comment-avatar{
  border: 2px solid #fff;
  border-radius: 50%;
  box-shadow: 0 1px 2px rgba(0, 0, 0, .2);
  height: 80px;
  left: 0;
  overflow: hidden;
  position: absolute;
  top: 0;
  width: 80px;
}

.comment-form .comment-avatar img,
.comment .comment-avatar img{
  display: block;
  height: auto;
  width: 100%;
}

.comment .comment-box{
  background-color: #fcfcfc;
  border-radius: 4px;
  box-shadow: 0 1px 1px rgba(0, 0, 0, .15);
  margin-left: 100px;
  min-height: 60px;
  position: relative;
  padding: 15px;
}

.comment .comment-box:before,
.comment .comment-box:after{
  border-width: 10px 10px 10px 0;
  border-style: solid;
  border-color: transparent #FCFCFC;
  content: "";
  left: -10px;
  position: absolute;
  top: 20px;
}

.comment .comment-box:before{
  border-color: transparent rgba(0, 0, 0, .05);
   top: 22px;
}

.comment .comment-text{
  color: #555f77;
  font-size: 15px;
  margin-bottom: 25px;
}

.comment .comment-footer{
  color: #acb4c2;
  font-size: 13px;
}

.comment .comment-footer:after{
  content: "";
  display: table;
  clear: both;
}

.comment .comment-footer a{
  color: #acb4c2;
  text-decoration: none;

  -webkit-transition: 350ms color;
  -moz-transition: 350ms color;
  -ms-transition: 350ms color;
  -o-transition: 350ms color;
  transition: 350ms color;
}

.comment .comment-footer a:hover{
  color: #555f77;
  text-decoration: underline;
}

.comment .comment-info{
  float: left;
  width: 85%;
}

.comment .comment-author{ }
.comment .comment-date{ }

.comment .comment-date:before{
  content: "|";
  margin: 0 10px;
}

.comment-actions{
  float: left;
  text-align: right;
  width: 15%;
}

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
                    <div class="row">
                    	<div class="col-md-12 sp-my-pham-nhat">
                        <form action="{{route('user.addToCart',['id'=>$product->id])}}" method="POST">
                          @csrf
                          @method('HEAD')
	                    	  <div class="NEW-Sanpham">
                            <h6><i class="far fa-star"></i>0 đánh giá/Bài viết</h6>
                            <h3>{{$product->name}}</h3>
                            <h4>
                              <del>{{$product->price}}</del>
                              @if(isset($product->sale))
                                {{$product->price - $product->price * $product->sale /100}}  
                                <span>Giảm 55%, tiết kiệm</span>
                              @endif
                            </h4>
                            <p>{{$product->thongtin}}</p>
                            <p>{{$product->desc}}</p>
                            <div>
                                <span class="minus" id="minus">-</span>
                                <input type="text" name="soluong" value="1"  readonly>
                                <span class="sum" id="sum">+</span>
                            </div>
                            <div>
                                <button class="btn-add" type="submit">Thêm vào giỏ</button>
                                <a href="{{route('user.showBuy',['id'=>$product->id])}}" class="btn-buy">Mua ngay</a>
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
                            <a href="">{{$item->pr_id}}</a>
                          </span>
                          <span class="comment-date">{{$item->created_at}}</span>
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

