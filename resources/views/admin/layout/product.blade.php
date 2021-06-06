@extends('admin.master.dashboard')
@section('main_content')
  <div ></div>
  {{ csrf_field() }}
  <div class="container">
    <div class="row col-md-4">
        <div class="input-group mb-3">
          <input type="text" id="search_product" class="form-control" placeholder="Nhập từ tìm kiếm" aria-label="Recipient's username" aria-describedby="button-addon2">
        </div>
        <div id="abc"></div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Thêm sản phẩm</button>
    </div>
      <table class="table-primary"></table>
      <table class="table-secondary"></table>
      <table class="table-success"></table>
      <table class="table-danger"></table>
      <table class="table-warning"></table>
      <table class="table-info"></table>
      <table class="table-light"></table>
      <table class="table-dark"></table>
      <table class="table caption-top">
          <caption>Danh sách sản phẩm</caption>
          <thead>
            <tr>
              <th scope="col">id</th>
              <th scope="col">Tên sản phẩm</th>
              <th scope="col">Loại sản phẩm</th>
              <th scope="col">Giá</th>
              <th scope="col">Số lượng</th>
              <th scope="col">Ảnh</th>
              <th scope="col">Thông tin</th>
              <th scope="col">Mô tả</th>
              <th scope="col">Mã giảm giá</th>
              <th scope="col">Tỷ lệ Sales</th>
              <th scope="col">Ngày nhập</th>
            </tr>
          </thead>
          <tbody id="list_pr">
              @foreach ($lus as $lu)
               <tr>
                  <th scope="row">{{$lu->id}}</th>
                      <td>{{$lu->name}}</td>
                      <td>{{$lu->loaisanpham->name}}</td>
                      <td>{{$lu->price}}</td>
                      <td>{{$lu->soluong}}</td>
                      <td><img src="{{asset('img')}}{{'/'.$lu->img}}" style="width: 6rem;height 8rem :" alt="photo" ></td>
                      <td>{!!$lu->thongtin!!}</td>
                      <td>{!!$lu->desc!!}</td>
                      <td>{{$lu->coupe}}</td>
                      <td>{{$lu->sale}}%</td>
                      <td>{{$lu->created_at}}</td>
                      <td>
                      <span><a onclick="return edit()" href="{{route('product.show',[$lu->id])}}"><i class="fas fa-edit"></i></a></span>
                      <form action="{{route('product.destroy',[$lu->id])}}" method="POST" onsubmit="return xoa()">
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
                  <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group">
                        <label for="exampleInputEmail1">Tên sản phẩm</label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp">
                        @error('name')
                          {{$message}}
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Loại sản phẩm</label>
                        @error('id_loaisp')
                          {{$message}}
                        @enderror
                        <select name="id_loaisp" id="id_loaisp" class="form-control" id="exampleFormControlSelect1">
                          @foreach ($lsp as $item)
                          <option value="{{$item->id}}">{{$item->name}}</option>    
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputEmail1">Giá</label>
                          @error('price')
                            {{$message}}
                          @enderror
                          <input type="text" class="form-control" name="price" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Số lượng</label>
                          @error('soluong')
                            {{$message}}
                          @enderror
                          <input type="text" class="form-control" name="soluong" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                          <label for="exampleFormControlFile1">Ảnh</label>
                          @error('img')
                            {{$message}}
                          @enderror
                          <input type="file" class="form-control-file" name="img" id="exampleFormControlFile1">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Thông tin</label>
                          <textarea id="edittor_pr" name="thongtin" class="form-control"id="" cols="30" rows="10"></textarea>
                          @error('thongtin')
                            {{$message}}
                          @enderror
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Mô tả</label>
                          <textarea name="desc"  class="form-control" id="edittor_desc" cols="30" rows="10"></textarea>
                          @error('desc')
                          {{$message}}
                          @enderror
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Mã giảm giá</label>
                          <input type="text" class="form-control" name="coupe" id="exampleFormControlFile1">
                          @error('coupe')
                          {{$message}}
                          @enderror
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Tỷ lệ sale</label>
                          <input type="text" class="form-control" name="sale" id="exampleFormControlFile1">
                          @error('sale')
                          {{$message}}
                          @enderror
                        </div>
                      <button type="submit" class="btn btn-primary">Thêm mới</button>
                    </form>
                </div>
                {{-- <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Send message</button>
                </div> --}}
              </div>
            </div>
          </div>
          <div><button type="button" class="btn btn-light"><span>{{$lus->links()}}</span></button></div>
@endsection
@push('scripts')
<script>
  $(document).ready(function(){
 
   $('#search_product').keyup(function(){ //bắt sự kiện keyup khi người dùng gõ từ khóa tim kiếm
     var query = $(this).val(); //lấy gía trị ng dùng gõ
       if(query != '') //kiểm tra khác rỗng thì thực hiện đoạn lệnh bên dưới
       {
       var _token = $('input[name="_token"]').val(); // token để mã hóa dữ liệu
       //$('#abc').html(_token);
       $.ajax({
         url:"{{ route('ajax.searchproduct')}}", // đường dẫn khi gửi dữ liệu đi 'search' là tên route 
         method:"POST", // phương thức gửi dữ liệu.
         data:{query:query, _token:_token},
         success:function(data){ //dữ liệu nhận về
         $('#list_pr').fadeIn();  
         $('#list_pr').html(data); //nhận dữ liệu dạng html và gán vào cặp thẻ có id là listpr
       }
     });
     }
   });
  });
</script>
@endpush