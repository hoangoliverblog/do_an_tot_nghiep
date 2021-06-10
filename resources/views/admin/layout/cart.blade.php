@extends('admin.master.dashboard')
@section('main_content')
    
  <div ></div>
  {{ csrf_field() }}
    <div class="row col-md-4">
        <div class="input-group mb-3">
          <input type="text" id="search_cart" class="form-control" placeholder="Nhập từ tìm kiếm" aria-label="Recipient's username" aria-describedby="button-addon2">
        </div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Thêm mới giỏ hàng</button>
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
              <th scope="col">Tên sản phẩm</th>
              <th scope="col">Số lượng</th>
              <th scope="col">Trạng thái</th>
              <th scope="col">Ngày thêm giỏ</th>
              <th scope="col">Thao tác</th>
            </tr>
          </thead>
          <tbody id="list_cart">
              @foreach ($lus as $lu)
               <tr>
                  <th scope="row">{{$lu->id}}</th>
                      <td>{{$lu->name}}</td>
                      <td>{{$lu->soluong}}</td>
                      <td>{{$lu->status}}</td>
                      <td>{{$lu->created_at}}</td>
                      <td>
                      <span><a onclick="return edit()" href="{{route('cart.show',[$lu->id])}}"><i class="fas fa-edit"></i></a></span>
                      <form action="{{route('cart.destroy',[$lu->id])}}" method="POST" onsubmit="return xoa()">
                          @csrf
                          @method('DELETE')
                          <button type="submit"><span><a href=""><i class="fas fa-trash-alt"></i></a></span></button>
                      </form>
                      </td>
                </tr>      
                @endforeach
          </tbody>
        </table>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm sản phẩm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <h3>Thêm sản phẩm</h3>
                <form action="{{route('cart.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label for="exampleInputEmail1">Id hóa đơn</label>
                      <input type="text" class="form-control" name="id_hd" id="exampleInputEmail1" aria-describedby="emailHelp">
                      @error('id_hd')
                        {{$message}}
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Tên sản phẩm</label>
                      <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp">
                      @error('name')
                        {{$message}}
                      @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Số lượng</label>
                        @error('soluong')
                          {{$message}}
                        @enderror
                        <input type="text" class="form-control" name="soluong" id="exampleInputEmail1" aria-describedby="emailHelp">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Tổng tiền</label>
                        @error('tongtien')
                          {{$message}}
                        @enderror
                        <input type="text" class="form-control" name="tongtien" id="exampleInputEmail1" aria-describedby="emailHelp">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Trạng thái</label>
                        <input type="text" class="form-control" name="status" id="exampleFormControlFile1">
                        @error('status')
                        {{$message}}
                        @enderror
                      </div>
                    <button type="submit" class="btn btn-primary">Thêm mới</button>
                  </form>
              </div>
            </div>
          </div>
        </div>
          <div><button type="button" class="btn btn-light"><span>{{$lus->links()}}</span></button></div>   
@endsection
@push('scripts')
<script>
  $(document).ready(function(){
 
   $('#search_cart').keyup(function(){ //bắt sự kiện keyup khi người dùng gõ từ khóa tim kiếm
     var query = $(this).val(); //lấy gía trị ng dùng gõ
       if(query != '') //kiểm tra khác rỗng thì thực hiện đoạn lệnh bên dưới
       {
       var _token = $('input[name="_token"]').val(); // token để mã hóa dữ liệu
       //$('#abc').html(_token);
       $.ajax({
         url:"{{ route('ajax.searchcart')}}", // đường dẫn khi gửi dữ liệu đi 'search' là tên route 
         method:"POST", // phương thức gửi dữ liệu.
         data:{query:query, _token:_token},
         success:function(data){ //dữ liệu nhận về
         $('#list_cart').fadeIn();  
         $('#list_cart').html(data); //nhận dữ liệu dạng html và gán vào cặp thẻ có id là listpr
       }
     });
     }
   });
  });
</script>
@endpush