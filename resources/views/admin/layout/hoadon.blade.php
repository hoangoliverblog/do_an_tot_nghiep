@extends('admin.master.dashboard')
@section('main_content')
    
  <div ></div>
  {{ csrf_field() }}
    <div class="row col-md-4">
        <div class="input-group mb-3">
          <input type="text" id="search_hoadon" class="form-control" placeholder="{{__('msg.EnterSearchWord')}}" aria-label="Recipient's username" aria-describedby="button-addon2">
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
          <caption>{{__('msg.BillList')}}</caption>
          <thead>
            <tr>
              <th scope="col">{{__('msg.BillCode')}}</th>
              <th scope="col">{{__('msg.UserName')}}</th>
              <th scope="col">{{__('msg.ProductName')}}</th>
              <th scope="col">{{__('msg.Address')}}</th>
              <th scope="col">{{__('msg.Amount')}}</th>
              <th scope="col">{{__('msg.Status')}}</th>
              <th scope="col">{{__('msg.Created_at')}}</th>
            </tr>
          </thead>
          <tbody id="list_hd">
              @foreach ($lus as $lu)
               <tr>
                  <th scope="row">{{$lu->id}}</th>
                      <td>{{$lu->user->name}}</td>
                      <td>{{$lu->sanpham->name}}</td>
                      <td>{{$lu->user->address}}</td>
                      <td>{{$sum =$lu->sanpham->soluong /* $lu->sanpham->price * */}}</td>
                      <td>{{$lu->status}}</td>
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
        $('#search_hoadon').keyup(function(){ //bắt sự kiện keyup khi người dùng gõ từ khóa tim kiếm
        var query = $(this).val(); //lấy gía trị ng dùng gõ
            if(query != '') //kiểm tra khác rỗng thì thực hiện đoạn lệnh bên dưới
            {
            var _token = $('input[name="_token"]').val(); // token để mã hóa dữ liệu
            $.ajax({
              url:"{{ route('ajax.searchhoadon') }}", // đường dẫn khi gửi dữ liệu đi 'search' là tên route 
              method:"POST", // phương thức gửi dữ liệu.
              data:{query:query, _token:_token},
              success:function(data){ //dữ liệu nhận về
              $('#list_hd').fadeIn();  
              $('#list_hd').html(data); //nhận dữ liệu dạng html và gán vào cặp thẻ có id là listpr
            }
          });
          }
        });
       });
    </script>
@endpush