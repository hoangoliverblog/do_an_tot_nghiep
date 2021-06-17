@extends('admin.master.dashboard')
@section('main_content')
    
  <div ></div>
  {{ csrf_field() }}
  <div class="container">
    <div class="row col-md-4">
        <div class="input-group mb-3">
          <input type="text" id="search_to_xeploai" class="form-control" placeholder="Nhập từ tìm kiếm" aria-label="Recipient's username" aria-describedby="button-addon2">
        </div>
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
          <caption>Xếp lại sản phẩm</caption>
          <thead>
            <tr>
              <th scope="col">id</th>
              <th scope="col">Loại sản phẩm</th>
              <th scope="col">Tên sản phẩm</th>
              <th scope="col">Giá sản phẩm</th>
              <th scope="col">Đánh giá</th>
            </tr>
          </thead>
          <tbody id="list_xl">
              @foreach ($lxl as $lu)
               <tr>
                  <th scope="row">{{$lu->id}}</th>
                      <td>{{$lu->sanpham}}</td>
                      <td>{{$lu->sanpham}}</td>
                      <td>{{$lu->sanpham}}</td>
                      <td>{{$lu->level}}</td>
                </tr>      
                @endforeach
          </tbody> 
        </table>
    <div><button type="button" class="btn btn-light"><span>{{$lxl->links()}}</span></button></div>
@endsection
@push('scripts')
{{-- <script>
  $(document).ready(function(){
 
   $('#search_to_xeploai').keyup(function(){ //bắt sự kiện keyup khi người dùng gõ từ khóa tim kiếm
     var query = $(this).val(); //lấy gía trị ng dùng gõ
       if(query != '') //kiểm tra khác rỗng thì thực hiện đoạn lệnh bên dưới
       {
       var _token = $('input[name="_token"]').val(); // token để mã hóa dữ liệu
       //$('#abc').html(_token);
       $.ajax({
         url:"{{ route('ajax.searchxeploai')}}", // đường dẫn khi gửi dữ liệu đi 'search' là tên route 
         method:"POST", // phương thức gửi dữ liệu.
         data:{query:query, _token:_token},
         success:function(data){ //dữ liệu nhận về
         $('#list_xl').fadeIn();  
         $('#list_xl').html(data); //nhận dữ liệu dạng html và gán vào cặp thẻ có id là listpr
       }
     });
     }
   });
  });
</script>
@endpush --}}