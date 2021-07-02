@extends('admin.master.dashboard')
@section('main_content')
<div class="container">
    <div class="row col-md-8">
        <div class="modal-body">
            <h3>{{__('msg.UpdateAccount')}}</h3>
            <form action="{{route('user.update',[$lu->id])}}" method="post" enctype="multipart/form-data">
              @method('PATCH')
              @csrf              
              <div class="form-group">
                <label for="exampleInputEmail1">{{__('msg.UserName')}}</label>
              <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$lu->name}}">
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
                  <label for="exampleInputEmail1">{{__('msg.Address')}}</label>
                  @error('address')
                    {{$message}}
                  @enderror
                  <input type="text" class="form-control" name="address" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$lu->address}}">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">{{__('msg.Phone')}}</label>
                  @error('phone')
                    {{$message}}
                  @enderror
                  <input type="text" class="form-control" name="phone" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$lu->phone}}">
                </div>
                <div class="form-group">
                  <label for="exampleFormControlFile1">{{__('msg.GenderType')}}</label>
                  @error('gioitinh')
                    {{$message}}
                  @enderror
                  <select name="gioitinh" id="gioitinh" class="form-control" id="exampleFormControlSelect1">
                    <option selected="selected" value="{{$lu->gioitinh}}">{{$lu->gioitinh}}</option>
                    <option value="Nam">{{__('msg.male')}}</option>
                    <option value="Nữ">{{__('msg.female')}}</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleFormControlFile1">{{__('msg.Status')}}</label>
                  @error('status')
                    {{$message}}
                  @enderror
                  <select name="status" id="status" class="form-control" id="exampleFormControlSelect1">
                    <option selected="selected" value="{{$lu->status}}">{{$lu->status}}</option>
                    <option value="Active">{{__('msg.Active')}}</option>
                    <option value="None active">{{__('msg.NoneActive')}}</option>
                  </select>
                </div>
              <button type="submit" class="btn btn-primary">{{__('msg.Update')}}</button>
            </form>
          </div>
    </div>
</div>
@endsection