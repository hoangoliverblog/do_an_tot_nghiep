<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <base href="#">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/d1bc342d1d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('lib/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('lib/style/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('lib/style/owl.theme.default.css')}}">
    <link rel="stylesheet" href="{{asset('lib/style/Homecss.css')}}">
    <title>Mỹ phẩm 365</title>
</head>
<body>
    <div class="hiden_icon">
        <span><i class="fas fa-bars"></i></span>
    </div>
    <!-- ++++++++++++++++++ header ++++++++++++++++++++ -->
    <div class="wapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-6 brand">
                    <div class="row">
                        <div class="col-sm-6 brand_img">
                        <a href="{{asset('/')}}"><img src="{{asset('lib/img/final_logo.jpg')}}" alt="logo"></a>
                        </div>
                        <div class="col-sm-6 brand_search">
                            <input type="text" name="searchProduct" id="searchProduct">
                            <span><i class="fas fa-search"></i></span>    
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="directory">
                        <ul>
                            @if (isset($user->name))
                            <li><span><i class="fas fa-user"></i></span><a href="{{route('user.Logout')}}">Đăng xuất</a></li>
                            @endif
                            <li><span><i class="fas fa-user"></i></span><a href="{{route('user.Login')}}">{{$user->name ?? 'Đăng nhập'}}</a></li>
                            @if (!isset($user->name))
                                <li><span><i class="fas fa-users"></i></span><a id="resgiter" href="{{route('user.Resgister')}}">Đăng kí</a></li>    
                            @endif
                            <li><span><i class="fas fa-dollar-sign"></i></span><a href="">Thanh toán</a></li>
                        </ul>
                    </div>
                    <div class="hot_new" >
                        <div class="hot_new_cart">
                            <span><i class="fas fa-female"></i><a href="">Bí quyết làm đẹp</a></span>
                            <span>
                                <a href="{{route('user.showCart',[$user->id ?? 'default'])}}">
                                    <i class="fas fa-shopping-cart">
                                        {{-- {{$countProductInCart ?? ''}} --}}
                                        @if(isset($countProductInCart) && $countProductInCart > 0)
                                            +
                                        @endif
                                    </i>
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- +++++++++++++++ end header ++++++++++++++++++++ -->

    <!-- ++++++++++++++++++ menu ++++++++++++++++++++ -->
    <div class="wapper menu_top">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 menu">
                    <ul class="root_menu">
                        <li class="root_home">
                          <a href="{{asset('/')}}">Trang chủ</a>
                            <div class="menu_dropdown">
                                <div class="row">
                                    <div class="col-xl-3 col-md-3 col-sm-3">
                                        <div class="row logo_product">
                                            <div class="logo_product_name">
                                                <span>Thương hiệu nổi bật</span>
                                            </div>
                                            <div class="col-xl-6 logo_product_img">
                                                <img src="{{asset('lib/img/final_logo.jpg')}}" alt="photo">
                                            </div>
                                            <div class="col-xl-6 logo_product_img">
                                                <img src="{{asset('lib/img/final_logo.jpg')}}" alt="photo">
                                            </div>
                                            <div class="col-xl-6 logo_product_img">
                                                <img src="{{asset('lib/img/final_logo.jpg')}}" alt="photo">
                                            </div>
                                            <div class="col-xl-6 logo_product_img">
                                                <img src="{{asset('lib/img/final_logo.jpg')}}" alt="photo">
                                            </div>
                                            <div class="col-xl-6 logo_product_img">
                                                <img src="{{asset('lib/img/final_logo.jpg')}}" alt="photo">
                                            </div>
                                            <div class="col-xl-6 logo_product_img">
                                                <img src="{{asset('lib/img/final_logo.jpg')}}" alt="photo">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6 col-sm-6">
                                        <div class="logo_product_name">
                                            <span>Danh sách mỹ phẩm</span>
                                        </div>
                                        <div class="list_product_name">
                                            <ul>
                                                <li><a href=""><i class="fas fa-angle-right"></i>link liên kết 1</a></li>
                                                <li><a href=""><i class="fas fa-angle-right"></i>link liên kết 1</a></li>
                                                <li><a href=""><i class="fas fa-angle-right"></i>link liên kết 1</a></li>
                                                <li><a href=""><i class="fas fa-angle-right"></i>link liên kết 1</a></li>
                                                <li><a href=""><i class="fas fa-angle-right"></i>link liên kết 1</a></li>
                                                <li><a href=""><i class="fas fa-angle-right"></i>link liên kết 1</a></li>
                                                <li><a href=""><i class="fas fa-angle-right"></i>link liên kết 1</a></li>
                                                <li><a href=""><i class="fas fa-angle-right"></i>link liên kết 1</a></li>
                                                <li><a href=""><i class="fas fa-angle-right"></i>link liên kết 1</a></li>
                                                <li><a href=""><i class="fas fa-angle-right"></i>link liên kết 1</a></li>
                                                <li><a href=""><i class="fas fa-angle-right"></i>link liên kết 1</a></li>
                                                <li><a href=""><i class="fas fa-angle-right"></i>link liên kết 1</a></li>
                                                <li><a href=""><i class="fas fa-angle-right"></i>link liên kết 1</a></li>
                                                <li><a href=""><i class="fas fa-angle-right"></i>link liên kết 1</a></li>
                                                <li><a href=""><i class="fas fa-angle-right"></i>link liên kết 1</a></li>
                                                <li><a href=""><i class="fas fa-angle-right"></i>link liên kết 1</a></li>
                                                <li><a href=""><i class="fas fa-angle-right"></i>link liên kết 1</a></li>
                                                <li><a href=""><i class="fas fa-angle-right"></i>link liên kết 1</a></li>
                                                <li><a href=""><i class="fas fa-angle-right"></i>link liên kết 1</a></li>
                                                <li><a href=""><i class="fas fa-angle-right"></i>link liên kết 1</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-3 col-sm-3">
                                        <div class="row logo_product">
                                            <div class="logo_product_name">
                                                <span>Sản phẩm mới</span>
                                            </div>
                                            <div class="new_product_menu">
                                                <div class="new_product_menu_img">
                                                    <img src="{{asset('lib/img/final_logo.jpg')}}" alt="photo">
                                                    <p>Tên sản phẩm là gì</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                        <a href="{{route('cosmetics.show')}}">Mỹ phẩm</a>
                        </li>
                        <li><a href="{{route('perfume.show')}}">Nước hoa</a></li>
                        <li><a href="{{route('Trademark.show')}}">Thương hiệu</a></li>
                        <li><a href="{{route('ProductSets.show')}}">Bộ sản phẩm</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>    
    <!-- ++++++++++++++++ end menu ++++++++++++++++++ -->  
       
    <!-- ++++++++++++++++ banner ++++++++++++++++++ -->
    <div class="banner">
        <div class="owl-carousel owl-theme">
            <div class="item slide_img"><img src="{{asset('lib/img/banner_green.jpg')}}" alt=""></div>
            <div class="item slide_img"><img src="{{asset('lib/img/banner_green.jpg')}}" alt=""></div>
            <div class="item slide_img"><img src="{{asset('lib/img/banner_green.jpg')}}" alt=""></div>
        </div>
    </div>
    <!-- ++++++++++++++++ end banner ++++++++++++++++++ -->

    <!-- ++++++++++++++++ all product ++++++++++++++++++ -->     

                <!-- *********** New product *********** -->
               <div>
                   @yield('content')
               </div>
                    
                <!-- ++++++++++++++++ end product ++++++++++++++++++ -->     


    <!-- ++++++++++++++++ footer ++++++++++++++++++ -->     

    <div class="wapper">
        <div class="row">
            <div class="col-sm-4 col-md-4 col-lg-4">
                <div class="footer">
                    <div class="footer_new">
                        <h3>Thông tin chung</h3>
                        <ul>
                            <li><a href="#">Về Chúng Tôi</a></li>
                            <li><a href="#">Chính Sách Vận Chuyển</a></li>
                            <li><a href="#">Chính Sách Riêng Tư</a></li>
                            <li><a href="#">Chính Sách Trả Hàng</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-md-4 col-lg-4">
                <div class="footer">
                    <div class="footer_new footer_contact">
                        <h3>Liên hệ với chúng tôi</h3>
                        <ul>
                            <li><a href="#">Tài khoản</a></li>
                            <li><a href="#">Lịch sử đơn hàng</a></li>
                            <li><a href="#">Thư thông báo(0)</a></li>
                            <li><a href="#">Yêu thích</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-md-4 col-lg-4">
                <div class="footer">
                    <div class="footer_new footer_link">
                        <h3>Liên kết</h3>
                        <span>
                            <i class="fab fa-facebook"></i>
                        </span>
                        <span>
                            <i class="fab fa-youtube"></i>
                        </span>
                        <span>
                            <i class="fab fa-google-plus-g"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

    <!-- ++++++++++++++++ end footer ++++++++++++++++++ -->     
<script src="{{asset('lib/bootstrap/js/jquery-3.4.1.min.js')}}"></script>
<script src="{{asset('lib/bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset('lib/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('lib/style/owl.carousel.min.js')}}"></script>
<script src="{{asset('lib/style/Homejs.js')}}"></script>
<script>
    function edit(){
        if(confirm("Bạn có muốn sửa sản phẩm?"))
        {
          return true;
        }
        else
        {
          return false;
        }
      }
      function xoa(){
        if(confirm("Bạn có muốn xóa sản phẩm?"))
        {
          return true;
        }
        else
        {
          return false;
        }
      }
</script>
</body>
</html>
