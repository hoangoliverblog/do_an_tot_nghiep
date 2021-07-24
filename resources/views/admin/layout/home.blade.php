@extends('admin.master.dashboard')
@section('main_content')
{{-- <div class="right_col" role="main">
  <!-- top tiles -->
  <div class="row" style="display: inline-block;" >
  <div class="tile_count">
    <div class="col-md-2 col-sm-4  tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Total Users</span>
      <div class="count">2500</div>
      <span class="count_bottom"><i class="green">4% </i> From last Week</span>
    </div>
    <div class="col-md-2 col-sm-4  tile_stats_count">
      <span class="count_top"><i class="fa fa-clock-o"></i> Average Time</span>
      <div class="count">123.50</div>
      <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>
    </div>
    <div class="col-md-2 col-sm-4  tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Total Males</span>
      <div class="count green">2,500</div>
      <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
    </div>
    <div class="col-md-2 col-sm-4  tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Total Females</span>
      <div class="count">4,567</div>
      <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>
    </div>
    <div class="col-md-2 col-sm-4  tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Total Collections</span>
      <div class="count">2,315</div>
      <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
    </div>
    <div class="col-md-2 col-sm-4  tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Total Connections</span>
      <div class="count">7,325</div>
      <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
    </div>
  </div>
</div>
  <!-- /top tiles --> --}}

  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <div class="dashboard_graph">

        <div class="row x_title">
          <div class="col-md-6">
            <h3>Trang quản trị <small>tổng quan</small></h3>
          </div>
          {{-- <div class="col-md-6">
            <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
              <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
              <span>{!! Form::datetime() !!}</span> <b class="caret"></b>
            </div>
          </div> --}}
        </div>
        {{-- <div class="col-md-9 col-sm-9 ">
          <div id="chart_plot_01" class="demo-placeholder"></div>
        </div> --}}
        {{-- <div class="clearfix"></div> --}}
      </div>
    </div>

  </div>
  <br />

  <div class="row">
    <div class="col-md-4 col-sm-4 ">
      <div class="x_panel tile fixed_height_320">
        <div class="x_title">
          <h2>Tổng quan người dùng</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="#">Settings 1</a>
                  <a class="dropdown-item" href="#">Settings 2</a>
                </div>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <h4>Quản lý tài khoản người dùng</h4>
          <div class="widget_summary">
          </div>
          <div style="text-align:center">
            <h3>Tổng quan người dùng</h3>
          </div>
          <div style="text-align:left">
            <label for="">Số lượng user :</label>
            <label for="" style="font-weight:bold">{{$aryToView['sumUser']}}</label> 
          </div>
          <div style="text-align:left">
            <label for="">Tài khoản chưa kích hoạt :</label>
            <label for=""style="font-weight:bold">{{$aryToView['sumUserNoneActive']}}</label>
          </div>
          <div style="text-align:left">
            <label for="">Thêm mới trong tháng :</label>
            <label for=""style="font-weight:bold">{{$aryToView['sumUserAddNewByMonth']}}</label>
          </div>

          {{-- <div class="widget_summary">
            <div class="w_left w_25">
              <span>Chưa kích hoạt</span>
            </div>
            <div class="w_center w_55">
              <div class="progress">
                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{$aryToView['sumUserNoneActive']}}%;">
                  <span class="sr-only">60% Complete</span>
                </div>
              </div>
            </div>
            <div class="w_right w_20">
              <span>{{$aryToView['sumUserNoneActive']}} user</span>
            </div>
            <div class="clearfix"></div>
          </div> --}}
          {{-- <div class="widget_summary">
            <div class="w_left w_25">
              <span>0.1.5.4</span>
            </div>
            <div class="w_center w_55">
              <div class="progress">
                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">
                  <span class="sr-only">60% Complete</span>
                </div>
              </div>
            </div>
            <div class="w_right w_20">
              <span>23k</span>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="widget_summary">
            <div class="w_left w_25">
              <span>0.1.5.5</span>
            </div>
            <div class="w_center w_55">
              <div class="progress">
                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 5%;">
                  <span class="sr-only">60% Complete</span>
                </div>
              </div>
            </div>
            <div class="w_right w_20">
              <span>3k</span>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="widget_summary">
            <div class="w_left w_25">
              <span>0.1.5.6</span>
            </div>
            <div class="w_center w_55">
              <div class="progress">
                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 8%;">
                  <span class="sr-only">60% Complete</span>
                </div>
              </div>
            </div>
            <div class="w_right w_20">
              <span>1k</span>
            </div>
            <div class="clearfix"></div>
          </div> --}}

        </div>
      </div>
    </div>

    <div class="col-md-4 col-sm-4 ">
      <div class="x_panel tile fixed_height_320 overflow_hidden">
        <div class="x_title">
          <h2>Tổng quan giỏ hàng</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="#">Settings 1</a>
                  <a class="dropdown-item" href="#">Settings 2</a>
                </div>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <table class="" style="width:100%">
            <tr>
              <th style="width:37%;">
                <p>Sản phẩm có nhiều lượt xem nhất :</p>
              </th>
              <th style="padding-left: 1rem">
                <div class="col-lg-7 col-md-7 col-sm-7 ">
                  <p class="">
                    {{$aryToView['nameProductViewCountMax'][0]}}
                  </p>
                </div>
              </th>
            </tr>
            <tr>
              <th style="width:37%;">
                <p>Sản phẩm ít được quan tâm nhất :</p>
              </th>
              <th style="padding-left: 1rem">
                <div class="col-lg-7 col-md-7 col-sm-7 ">
                  <p class="">
                    {{$aryToView['nameProductViewCountMin'][0]}}
                  </p>
                </div>
              </th>
            </tr>
            <div style="text-align:left">
              <label for="">Loại sản phẩm được yêu thích :</label>
              <label for="" style="font-weight:bold">{{$aryToView['nameProductLike']}}</label> 
            </div>
            <div style="text-align:left">
              <label for="">Số sản phẩm chưa được thanh toán:</label>
              <label for="" style="font-weight:bold">{{$aryToView['sumProductNotPay']}}</label>
            </div>
            <div style="text-align:left">
              <label for="">Sản phẩm của tháng:</label>
              <label for="" style="font-weight:bold">{{$aryToView['nameProductOfMonth']}}</label>
            </div>
          </table>
        </div>
      </div>
    </div>


    <div class="col-md-4 col-sm-4 ">
      <div class="x_panel tile fixed_height_320">
        <div class="x_title">
          <h2>Doanh thu</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="#">Settings 1</a>
                  <a class="dropdown-item" href="#">Settings 2</a>
                </div>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div style="text-align:left">
          <h2 style="display:inline-block">Tổng doanh thu :</h2>
          <label for="" style="font-weight:bold">
            @if (strlen($aryToView['sumRevenueByMonth'] < 6))
            {{substr($aryToView['sumRevenueByMonth'],0,-3) . '.' . substr($aryToView['sumRevenueByMonth'], -3)}} VNĐ
            @else
            {{ substr($aryToView['sumRevenueByMonth'],0,-9) . '.' . substr($aryToView['sumRevenueByMonth'],1,-6) . '.' . substr($aryToView['sumRevenueByMonth'],4,-3) . '.' . substr($aryToView['sumRevenueByMonth'], -3) }} VNĐ
            @endif
          </label> 
        </div>
        <div style="text-align:left">
          <label for="">Số đơn hàng còn chưa thanh toán:</label>
          <label for="" style="font-weight:bold">{{$aryToView['numberOfUnpaidOrders']}}</label>
        </div>
        <div style="text-align:left">
          <label for="">Số lượng đã bán trong tháng:</label>
          <label for="" style="font-weight:bold">{{$aryToView['sumInTheMonth']}}</label>
        </div>
        <div class="x_content">
          <div class="dashboard-widget-content">
            <ul class="quick-list">
                @foreach ($topHoaDon as $item)
                <li><i class="fa fa-calendar-o"></i><a href="#">{{$item->sanpham->name}}</a>
                </li>
                @endforeach
            </ul>

            <div class="sidebar-widget">
                <canvas width="150" height="80" id="chart_gauge_01" class="" style="width: 160px; height: 100px;"></canvas>
                <div class="goal-wrapper">
                  <span id="gauge-text" class="gauge-value pull-left"></span>
                  <span class="gauge-value pull-left"></span>
                  <span id="goal-text" class="goal-value pull-right"></span>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>


  <div class="row">
    <div class="col-md-4 col-sm-4 ">
      <div class="x_panel">
        <div class="x_title">
          <h2>Bình luận khách hàng <small>Sessions</small></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="#">Settings 1</a>
                  <a class="dropdown-item" href="#">Settings 2</a>
                </div>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="dashboard-widget-content">

            <ul class="list-unstyled timeline widget">
              <div style="text-align:left">
                <label style="font-size: 20px" for="">Tổng bình luận :</label>
                <label for="">{{$aryToView['sumComment']}}</label> 
              </div>
              <div style="text-align:left">
                <label for="">Số lượng đánh giá tốt trong tháng:</label>
                <label for="">{{$aryToView['sumGoodComment']}}</label>
              </div>
              @foreach ($commentView as $item)
              <li>
                <div class="block">
                  <div class="block_content">
                    <h2 class="title">
                        <a>{{$item->product->name}}</a>
                    </h2>
                    <div class="byline">
                      <span>by <a>{{$item->user->name}}</a>
                    </div>
                    <p class="excerpt">{{$item->content}}</a>
                    </p>
                  </div>
                </div>
              </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>


    <div class="col-md-8 col-sm-8 ">



      <div class="row">

        <div class="col-md-12 col-sm-12 ">
          <div class="x_panel">
            <div class="x_title">
              <h2>Đánh giá sản phẩm<small>geo-presentation</small></h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="#">Settings 1</a>
                      <a class="dropdown-item" href="#">Settings 2</a>
                    </div>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <div class="dashboard-widget-content">
                <div class="col-md-4 hidden-small">
                  <h2 class="line_30">Tổng số lượt xem :{{$aryToView['sumProductViewCountMax']}}</h2>
                  <div style="text-align:left">
                    <h2 style="display:inline-block">Đánh giá cao nhất :</h2>
                    <label for="">
                      {{$aryToView['nameProductLike']}}
                    </label> 
                  </div>
                  <div style="text-align:left">
                    <label for="">Sản phẩm nổi bật:</label>
                    <label for="">{{$aryToView['nameProductOfMonth']}}</label>
                  </div>
                  <table class="countries_list">
                    <tbody>
                      @foreach ($topProduct as $item)
                        <tr>
                          <td>{{$item->name}}</td>
                          <td class="fs15 fw700 text-right">{{$item->viewcount}}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <div id="world-map-gdp" class="col-md-8 col-sm-12 " style="height:230px;"></div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection