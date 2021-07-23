@extends('admin.master.dashboard')
@section('main_content')
    
  <div ></div>
  {{ csrf_field() }}
    <div class="row col-md-4">
        <div class="input-group mb-3">
          <input type="text" id="search_cart" class="form-control" placeholder="{{__('msg.shoppingCartList')}}" aria-label="Recipient's username" aria-describedby="button-addon2">
        </div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">{{__('msg.AddCart')}}</button>
    </div>
  <div class="container">
      <table class="table caption-top">
          <caption>{{__('msg.CartList')}}</caption>
          <thead>
            <tr>
              <th scope="col">{{__('msg.CartCode')}}</th>
              <th scope="col">{{__('msg.UserName')}}</th>
              <th scope="col">{{__('msg.ProductName')}}</th>
              <th scope="col">{{__('msg.Amount')}}</th>
              <th scope="col">{{__('msg.Status')}}</th>
              <th scope="col">{{__('msg.Created_at')}}</th>
              <th scope="col">{{__('msg.Manipulation')}}</th>
            </tr>
          </thead>
          <tbody id="list_cart">
              @foreach ($lus as $lu)
               <tr>
                  <th scope="row">{{$lu->id}}</th>
                      <td>{{$lu->user->name}}</td>
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
                <h5 class="modal-title" id="exampleModalLabel">{{__('msg.AddNew')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <h3>{{__('msg.AddCart')}}</h3>
                <form action="{{route('cart.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label for="exampleInputEmail1">{{__('msg.BillCode')}}</label>
                      <input type="text" class="form-control" name="id_hd" id="exampleInputEmail1" aria-describedby="emailHelp">
                      @error('id_hd')
                        {{$message}}
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">{{__('msg.ProductName')}}</label>
                      <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp">
                      @error('name')
                        {{$message}}
                      @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">{{__('msg.Amount')}}</label>
                        @error('soluong')
                          {{$message}}
                        @enderror
                        <input type="text" class="form-control" name="soluong" id="exampleInputEmail1" aria-describedby="emailHelp">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">{{__('msg.Price')}}</label>
                        @error('tongtien')
                          {{$message}}
                        @enderror
                        <input type="text" class="form-control" name="tongtien" id="exampleInputEmail1" aria-describedby="emailHelp">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">{{__('msg.Status')}}</label>
                        <input type="text" class="form-control" name="status" id="exampleFormControlFile1">
                        @error('status')
                        {{$message}}
                        @enderror
                      </div>
                    <button type="submit" class="btn btn-primary">{{__('msg.AddNew')}}</button>
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