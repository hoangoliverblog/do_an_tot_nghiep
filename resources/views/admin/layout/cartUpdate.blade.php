@extends('admin.master.dashboard')
@section('main_content')
<div class="container">
    <div class="row col-md-8">
        <div class="modal-body">
            <h3>{{__('msg.UpdateCart')}}</h3>
            <form action="{{route('cart.update',[$lsp->id])}}" method="post" enctype="multipart/form-data">
              @method('PATCH')
              @csrf
                <div class="form-group">
                  <label for="exampleInputEmail1">{{__('msg.CartCode')}}</label>
                  <input type="text" class="form-control" name="id_hd" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$lsp->hd_id}}">
                  @error('id_hd')
                    {{$message}}
                  @enderror
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">{{__('msg.ProductName')}}</label>
                  <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$lsp->name}}">
                  @error('name')
                    {{$message}}
                  @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">{{__('msg.Amount')}}</label>
                    @error('soluong')
                      {{$message}}
                    @enderror
                    <input type="text" class="form-control" name="soluong" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$lsp->soluong}}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">{{__('msg.Price')}}</label>
                    @error('tongtien')
                      {{$message}}
                    @enderror
                    <input type="text" class="form-control" name="tongtien" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$lsp->sum}}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">{{__('msg.Status')}}</label>
                    <select name="status" class="custom-select">
                      <option value="Đơn hàng đã đặt" selected>Đơn hàng đã đặt</option>
                      <option value="Đã giao cho đơn vị vận chuyển">Đã giao cho đơn vị vận chuyển</option>
                      <option value="Đơn hàng đã nhận">Đơn hàng đã nhận</option>
                      <option value="Đơn hàng đã giao">Đơn hàng đã giao</option>
                      <option value="Đã hủy">Hủy đơn hàng</option>
                    </select>
                    {{-- <input type="text" class="form-control" name="status" id="exampleFormControlFile1" value="{{$lsp->status}}"> --}}
                    @error('status')
                    {{$message}}
                    @enderror
                  </div>
                <button type="submit" class="btn btn-primary">{{__('msg.UpdateCart')}}</button>
              </form>
          </div>
    </div>
</div>
@endsection