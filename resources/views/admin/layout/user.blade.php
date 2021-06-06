@extends('admin.master.dashboard')
@section('main_content')
    
  <div ></div>
  {{ csrf_field() }}
  <div class="container">
    <div class="row col-md-4">
        <div class="input-group mb-3">
          <input type="text" id="search_user" class="form-control" placeholder="Nhập từ tìm kiếm" aria-label="Recipient's username" aria-describedby="button-addon2">
        </div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Thêm tài khoản</button>
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
          <caption>Danh sách người dùng</caption>
          <thead>
            <tr>
              <th scope="col">id</th>
              <th scope="col">Tên người dùng</th>
              <th scope="col">Email</th>
              <th scope="col">Loại tài khoản</th>
              <th scope="col">Địa chỉ</th>
              <th scope="col">Số điện thoại</th>
              <th scope="col">Giới tính</th>
              <th scope="col">Trạng thái</th>
              <th scope="col">Ngày tạo</th>
            </tr>
          </thead>
          <tbody id="list_lu">
              @foreach ($lus as $lu)
               <tr>
                  <th scope="row">{{$lu->id}}</th>
                      <td>{{$lu->name}}</td>
                      <td>{{$lu->email}}</td>
                      <td>{{$lu->role_user->role_name}}</td>
                      <td>{{$lu->address}}</td>
                      <td>{{$lu->phone}}</td>
                      <td>{{$lu->gioitinh}}</td>
                      <td>{{$lu->status}}</td>
                      <td>{{$lu->created_at}}</td>
                      <td>
                      <span><a onclick="return edit()" href="{{route('user.show',[$lu->id])}}"><i class="fas fa-edit"></i></a></span>
                      <form action="{{route('user.destroy',[$lu->id])}}" method="POST" onsubmit="return xoa()">
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
                  <h5 class="modal-title" id="exampleModalLabel">Thêm tài khoản</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <h3>Thêm tài khoản</h3>
                  <form action="{{route('user.store')}}" method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group">
                        <label for="exampleInputEmail1">Tên người dùng</label>
                        <input type="text" class="form-control" name="name"  aria-describedby="emailHelp">
                        @error('name')
                          {{$message}}
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        @error('email')
                          {{$message}}
                        @enderror
                        <input type="text" class="form-control" name="email"  aria-describedby="emailHelp">
                      </div>
                      <div class="form-group">
                          <label for="exampleInputEmail1">Địa chỉ</label>
                          @error('address')
                            {{$message}}
                          @enderror
                          <input type="text" class="form-control" name="address"  aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Số điện thoại</label>
                          @error('phone')
                            {{$message}}
                          @enderror
                          <input type="text" class="form-control" name="phone" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                          <label for="exampleFormControlFile1">Giới tính</label>
                          @error('gioitinh')
                            {{$message}}
                          @enderror
                          <input type="text" class="form-control" name="gioitinh" >
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Mật khẩu</label>
                          <input type="password" class="form-control" name="password">
                          @error('password')
                            {{$message}}
                          @enderror
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Nhập lại mật khẩu</label>
                          <input type="password" class="form-control" name="re_password" >
                          @error('re_password')
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
        </table>
@endsection
@push('scripts')
    <script>
       $(document).ready(function(){
        $('#search_user').keyup(function(){ //bắt sự kiện keyup khi người dùng gõ từ khóa tim kiếm
        var query = $(this).val(); //lấy gía trị ng dùng gõ
            if(query != '') //kiểm tra khác rỗng thì thực hiện đoạn lệnh bên dưới
            {
            var _token = $('input[name="_token"]').val(); // token để mã hóa dữ liệu
            $.ajax({
              url:"{{ route('ajax.searchuser') }}", // đường dẫn khi gửi dữ liệu đi 'search' là tên route 
              method:"POST", // phương thức gửi dữ liệu.
              data:{query:query, _token:_token},
              success:function(data){ //dữ liệu nhận về
              $('#list_lu').fadeIn();  
              $('#list_lu').html(data); //nhận dữ liệu dạng html và gán vào cặp thẻ có id là listpr
            }
          });
          }
        });
       });
    </script>
@endpush