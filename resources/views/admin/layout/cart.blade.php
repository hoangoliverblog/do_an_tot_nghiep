@extends('admin.master.dashboard')
@section('main_content')
    
  <div ></div>
  {{ csrf_field() }}
    <div class="row col-md-4">
        <div class="input-group mb-3">
          <input type="text" id="search_hoadon" class="form-control" placeholder="Nhập từ tìm kiếm" aria-label="Recipient's username" aria-describedby="button-addon2">
        </div>
    </div>
  <div class="container">
      <table class="table-primary"></table>
      <table class="table-secondary"></table>
      <table class="table-success"></table>
      <table class="table-danger"></table>
      <table class="table-warning"></table>
      <table class="table-info"></table>
      <table class="table-light"></table>
      <table class="table-dark"></table>
      <table class="table caption-top">
          <caption>Danh sách giỏ hàng</caption>
          <thead>
            <tr>
              <th scope="col">Mã giỏ hàng</th>
              <th scope="col">Email</th>
              <th scope="col">Tên sản phẩm</th>
              <th scope="col">Số lượng</th>
              <th scope="col">Tổng tiền</th>
              <th scope="col">Ngày thêm giỏ</th>
            </tr>
          </thead>
          <tbody id="list_hd">
              @foreach ($lus as $lu)
               <tr>
                  <th scope="row">{{$lu->id}}</th>
                      <td>{{$lu->hoadon->user->email}}</td>
                      <td>{{$lu->hoadon->sanpham->name}}</td>
                      <td>{{$lu->hoadon->sanpham->soluong}}</td>
                      <td>{{$sum = $lu->hoadon->sanpham->price * $lu->hoadon->sanpham->soluong}} vnđ</td>
                      <td>{{$lu->created_at}}</td>
                      <td>
                      <form action="{{route('cart.destroy',[$lu->id])}}" method="POST" onsubmit="xoa()">
                          @csrf
                          @method('DELETE')
                          <button type="submit"><span><a href=""><i class="fas fa-trash-alt"></i></a></span></button>
                      </form>
                      </td>
                </tr>      
                @endforeach
          </tbody>
          
        </table>
          <div><button type="button" class="btn btn-light"><span>{{$lus->links()}}</span></button></div>
      
@endsection