@extends('admin.master.dashboard')
@section('main_content')
  <div ></div>
  {{ csrf_field() }}
  <div class="container">
    <div class="row col-md-4">
        <div class="input-group mb-3">
          <input type="text" id="search_product" class="form-control" placeholder="{{__('msg.EnterSearchWord')}}" aria-label="Recipient's username" aria-describedby="button-addon2">
        </div>
        <div id="abc"></div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">{{__('msg.MoreProduct')}}</button>
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
          <caption>{{__('msg.ListProduct')}}</caption>
          <thead>
            <tr>
              <th scope="col">id</th>
              <th scope="col">{{__('msg.ProductName')}}</th>
              <th scope="col">{{__('msg.ProductType')}}</th>
              <th scope="col">{{__('msg.Price')}}</th>
              <th scope="col">{{__('msg.Amount')}}</th>
              <th scope="col">{{__('msg.Image')}}</th>
              <th scope="col">{{__('msg.Infomation')}}</th>
              <th scope="col">{{__('msg.Description')}}</th>
              <th scope="col">{{__('msg.Coupe')}}</th>
              <th scope="col">{{__('msg.SaleRate')}}</th>
              <th scope="col">{{__('msg.Created_at')}}</th>
              <th scope="col">{{__('msg.Manipulation')}}</th>
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
                  <h5 class="modal-title" id="exampleModalLabel">{{__('msg.AddProduct')}}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <h3>{{__('msg.AddProduct')}}</h3>
                  <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group">
                        <label for="exampleInputEmail1">{{__('msg.ProductName')}}</label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp">
                        @error('name')
                          {{$message}}
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">{{__('msg.ProductType')}}</label>
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
                          <label for="exampleInputEmail1">{{__('msg.Price')}}</label>
                          @error('price')
                            {{$message}}
                          @enderror
                          <input type="text" class="form-control" name="price" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">{{__('msg.Amount')}}</label>
                          @error('soluong')
                            {{$message}}
                          @enderror
                          <input type="text" class="form-control" name="soluong" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                          <label for="exampleFormControlFile1">{{__('msg.Image')}}</label>
                          @error('img')
                            {{$message}}
                          @enderror
                          <input type="file" class="form-control-file" name="img" id="exampleFormControlFile1">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">{{__('msg.Infomation')}}</label>
                          <textarea id="edittor_pr" name="thongtin" class="form-control"id="" cols="30" rows="10"></textarea>
                          @error('thongtin')
                            {{$message}}
                          @enderror
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">{{__('msg.Description')}}</label>
                          <textarea name="desc"  class="form-control" id="edittor_desc" cols="30" rows="10"></textarea>
                          @error('desc')
                          {{$message}}
                          @enderror
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">{{__('msg.Coupe')}}</label>
                          <input type="text" class="form-control" name="coupe" id="exampleFormControlFile1">
                          @error('coupe')
                          {{$message}}
                          @enderror
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">{{__('msg.SaleRate')}}</label>
                          <input type="text" class="form-control" name="sale" id="exampleFormControlFile1">
                          @error('sale')
                          {{$message}}
                          @enderror
                        </div>
                      <button type="submit" class="btn btn-primary">{{__('msg.AddProduct')}}</button>
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
 
   $('#search_product').keyup(function(){ //b???t s??? ki???n keyup khi ng?????i d??ng g?? t??? kh??a tim ki???m
     var query = $(this).val(); //l???y g??a tr??? ng d??ng g??
       if(query != '') //ki???m tra kh??c r???ng th?? th???c hi???n ??o???n l???nh b??n d?????i
       {
       var _token = $('input[name="_token"]').val(); // token ????? m?? h??a d??? li???u
       //$('#abc').html(_token);
       $.ajax({
         url:"{{ route('ajax.searchproduct')}}", // ???????ng d???n khi g???i d??? li???u ??i 'search' l?? t??n route 
         method:"POST", // ph????ng th???c g???i d??? li???u.
         data:{query:query, _token:_token},
         success:function(data){ //d??? li???u nh???n v???
         $('#list_pr').fadeIn();  
         $('#list_pr').html(data); //nh???n d??? li???u d???ng html v?? g??n v??o c???p th??? c?? id l?? listpr
       }
     });
     }
   });
  });
</script>
@endpush