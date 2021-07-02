@extends('admin.master.dashboard')
@section('main_content')
    
  <div ></div>
  {{ csrf_field() }}
  <div class="container">
    <div class="row col-md-4">
        <div class="input-group mb-3">
          <input type="text" id="search_user" class="form-control" placeholder="{{__('msg.EnterSearchWord')}}" aria-label="Recipient's username" aria-describedby="button-addon2">
        </div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">{{__('msg.MoreAccount')}}</button>
        @if(isset($message_pass))
        {{$message_pass}}
        @endif
    </div>
      <table class="table caption-top">
          <caption>{{__('msg.UserList')}}</caption>
          <thead>
            <tr>
              <th scope="col">id</th>
              <th scope="col">{{__('msg.UserName')}}</th>
              <th scope="col">{{__('msg.Image')}}</th>
              <th scope="col">{{__('msg.Email')}}</th>
              <th scope="col">{{__('msg.AccountType')}}</th>
              <th scope="col">{{__('msg.Address')}}</th>
              <th scope="col">{{__('msg.Phone')}}</th>
              <th scope="col">{{__('msg.GenderType')}}</th>
              <th scope="col">{{__('msg.Status')}}</th>
              <th scope="col">{{__('msg.Created_at')}}</th>
              <th scope="col">{{__('msg.Manipulation')}}</th>
            </tr>
          </thead>
          <tbody id="list_lu">
              @foreach ($lus as $lu)
               <tr>
                  <th scope="row">{{$lu->id}}</th>
                      <td>{{$lu->name}}</td>
                      <td><img src="{{asset('img')}}{{'/'.$lu->image}}" style="width: 6rem;height 8rem :" alt="photo" ></td>
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
                  <h5 class="modal-title" id="exampleModalLabel">{{__('msg.MoreAccount')}}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <h3>{{__('msg.MoreAccount')}}</h3>
                  <form action="{{route('user.store')}}" method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group">
                        <label for="exampleInputEmail1">{{__('msg.UserName')}}</label>
                        <input type="text" class="form-control" name="name">
                        @error('name')
                          {{$message}}
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="exampleFormControlFile1">{{__('msg.Image')}}</label>
                        @error('img')
                          {{$message}}
                        @enderror
                        <input type="file" class="form-control-file" name="img" id="exampleFormControlFile1">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">{{__('msg.Email')}}</label>
                        @error('email')
                          {{$message}}
                        @enderror
                        <input type="text" class="form-control" name="email"  aria-describedby="emailHelp">
                      </div>
                      <div class="form-group">
                          <label for="exampleInputEmail1">{{__('msg.Address')}}</label>
                          @error('address')
                            {{$message}}
                          @enderror
                          <input type="text" class="form-control" name="address"  aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">{{__('msg.Phone')}}</label>
                          @error('phone')
                            {{$message}}
                          @enderror
                          <input type="text" class="form-control" name="phone" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                          <label for="exampleFormControlFile1">{{__('msg.GenderType')}}</label>
                          @error('gioitinh')
                            {{$message}}
                          @enderror
                          <input type="text" class="form-control" name="gioitinh" >
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">{{__('msg.Password')}}</label>
                          <input type="password" class="form-control" name="password">
                          @error('password')
                            {{$message}}
                          @enderror
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">{{__('msg.Re_password')}}</label>
                          <input type="password" class="form-control" name="re_password" >
                          @error('massage')
                          {{$message}}
                          @enderror
                        </div>
                      <button type="submit" class="btn btn-primary">{{__('msg.AddNew')}}</button>
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
        $('#search_user').keyup(function(){ 
        var query = $(this).val(); 
            if(query != '') 
            {
            var _token = $('input[name="_token"]').val(); 
            $.ajax({
              url:"{{ route('ajax.searchuser') }}", 
              method:"POST", 
              data:{query:query, _token:_token},
              success:function(data){ 
              $('#list_lu').fadeIn();  
              $('#list_lu').html(data); 
            }
          });
          }
        });
       });
    </script>
@endpush