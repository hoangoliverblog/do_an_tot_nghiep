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
        $('#search_hoadon').keyup(function(){ //b???t s??? ki???n keyup khi ng?????i d??ng g?? t??? kh??a tim ki???m
        var query = $(this).val(); //l???y g??a tr??? ng d??ng g??
            if(query != '') //ki???m tra kh??c r???ng th?? th???c hi???n ??o???n l???nh b??n d?????i
            {
            var _token = $('input[name="_token"]').val(); // token ????? m?? h??a d??? li???u
            $.ajax({
              url:"{{ route('ajax.searchhoadon') }}", // ???????ng d???n khi g???i d??? li???u ??i 'search' l?? t??n route 
              method:"POST", // ph????ng th???c g???i d??? li???u.
              data:{query:query, _token:_token},
              success:function(data){ //d??? li???u nh???n v???
              $('#list_hd').fadeIn();  
              $('#list_hd').html(data); //nh???n d??? li???u d???ng html v?? g??n v??o c???p th??? c?? id l?? listpr
            }
          });
          }
        });
       });
    </script>
@endpush