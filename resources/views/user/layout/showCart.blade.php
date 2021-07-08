@extends('user.master.home')
@section('content')
<div class="container"> 
  <div class="alert alert-success" role="alert" style="text-align: center">
    Danh sách chi tiết các sản phẩm đã được thêm vào giỏ    
  </div>
</div>
<div class="container">
  <form action="{{route('user.showPayMent')}}" method="GET">
    @csrf
    <div>
      <button type="submit" class="btn btn-success" style="margin-bottom: 5px">Thanh toán</button>
    </div>
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col"></th>
          <th scope="col">Tên sản phẩm</th>
          <th scope="col">Số lượng</th>
          <th scope="col">Tổng tiền</th>
          <th scope="col">Ngày tạo</th>
          <th scope="col">Thao tác</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($data as $item)
          <tr>
              <td>
              <input type="checkbox" name="checkbox-{{$item->id}}" value="{{$item->name}}">
              </td>
              <th scope="row">{{$item->name}}</th>
              <td>{{$item->soluong}}</td>
              <td>{{$item->sum}}</td>
              <td>{{$item->created_at}}</td>
              <td>
                  <span><a onclick="return edit()" href="{{route('user.showBuy',['id'=>$item->id])}}" style="color:#43c943"><i class="fas fa-edit"></i></a></span>
                  <span><a onclick="return xoa()" href="{{route('user.deleteProductsInCart',['id'=>$item->id])}}" style="color:#43c943"><i class="fas fa-trash-alt"></i></a></span>
              </td>
          </tr>
          @endforeach
      </tbody>
    </table>
  </form>
</div>
@endsection
@push('scripts')
<script>
  
</script>
@endpush

