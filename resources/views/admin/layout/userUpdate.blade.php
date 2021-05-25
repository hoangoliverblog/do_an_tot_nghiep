@extends('admin.master.dashboard')
@section('main_content')
<div class="container">
    <div class="row col-md-8">
        <div class="modal-body">
            <h3>Cập nhật tài khoản</h3>
            <form action="{{route('user.update',[$lu->id])}}" method="post" enctype="multipart/form-data">
              @method('PATCH')
              @csrf              
              <div class="form-group">
                <label for="exampleInputEmail1">Tên người dùng</label>
              <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$lu->name}}">
                @error('name')
                  {{$message}}
                @enderror
              </div>
              <div class="form-group">
                  <label for="exampleInputEmail1">Địa chỉ</label>
                  @error('address')
                    {{$message}}
                  @enderror
                  <input type="text" class="form-control" name="address" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$lu->address}}">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Số điện thoại</label>
                  @error('phone')
                    {{$message}}
                  @enderror
                  <input type="text" class="form-control" name="phone" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$lu->phone}}">
                </div>
                <div class="form-group">
                  <label for="exampleFormControlFile1">Giới tính</label>
                  @error('gioitinh')
                    {{$message}}
                  @enderror
                  <select name="gioitinh" id="gioitinh" class="form-control" id="exampleFormControlSelect1">
                    <option selected="selected" value="{{$lu->gioitinh}}">{{$lu->gioitinh}}</option>
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleFormControlFile1">Trạng thái</label>
                  @error('status')
                    {{$message}}
                  @enderror
                  <select name="status" id="status" class="form-control" id="exampleFormControlSelect1">
                    <option selected="selected" value="{{$lu->status}}">{{$lu->status}}</option>
                    <option value="Active">Active</option>
                    <option value="None active">None active</option>
                  </select>
                </div>
              <button type="submit" class="btn btn-primary">Cập nhật</button>
            </form>
          </div>
    </div>
</div>
@endsection