@extends('admin.master.dashboard')
@section('main_content')
    
  <div ></div>
  {{ csrf_field() }}
    <div class="row col-md-4">
        <div class="input-group mb-3">
          <input type="text" id="search_chitiethoadon" class="form-control" placeholder="Nhập từ tìm kiếm" aria-label="Recipient's username" aria-describedby="button-addon2">
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
          <caption>Chi tiết hóa đơn</caption>
          <thead>
            <tr>
              <th scope="col">Mã hóa đơn</th>
              <th scope="col">Tên người dùng</th>
              <th scope="col">Loại tài khoản</th>
              <th scope="col">Tên sản phẩm</th>
              <th scope="col">Giá sản phẩm</th>
              <th scope="col">Địa chỉ</th>
              <th scope="col">Số điện thoại</th>
              <th scope="col">Tổng thanh toán</th>
              <th scope="col">Ngày tạo</th>
              <th scope="col">Thao tác</th>
            </tr>
          </thead>
          <tbody id="list_chitiethd">
                @foreach ($lus as $lu)
                <tr>
                    <th scope="row">{{$lu->id}}</th>
                        <td>{{$lu->hoadon->user->name}}</td>
                        <td>{{$lu->hoadon->user->role_user->role_name}}</td>
                        <td>{{$lu->hoadon->sanpham->name}}</td>
                        <td>{{$lu->hoadon->sanpham->price}}</td>
                        <td>{{$lu->hoadon->user->address}}</td>
                        <td>{{$lu->hoadon->user->phone}}</td>
                        <td>{{$sum = $lu->hoadon->sanpham->price * $lu->hoadon->sanpham->soluong}} vnđ</td>
                        <td>{{$lu->created_at}}</td>
                        <td>
                        <form action="{{route('hoadon.destroy',[$lu->id])}}" method="POST" onsubmit="return xoa()">
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
@push('scripts')
    <script>
       $(document).ready(function(){
        $('#search_chitiethoadon').keyup(function(){ //bắt sự kiện keyup khi người dùng gõ từ khóa tim kiếm
        var query = $(this).val(); //lấy gía trị ng dùng gõ
            if(query != '') //kiểm tra khác rỗng thì thực hiện đoạn lệnh bên dưới
            {
            var _token = $('input[name="_token"]').val(); // token để mã hóa dữ liệu
            $.ajax({
              url:"{{ route('ajax.searchchitiethoadon') }}", // đường dẫn khi gửi dữ liệu đi 'search' là tên route 
              method:"POST", // phương thức gửi dữ liệu.
              data:{query:query, _token:_token},
              success:function(data){ //dữ liệu nhận về
              $('#list_chitiethd').fadeIn();  
              $('#list_chitiethd').html(data); //nhận dữ liệu dạng html và gán vào cặp thẻ có id là listpr
            }
          });
          }
        });
       });
    </script>
@endpush