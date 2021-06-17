@extends('admin.master.dashboard')
@section('main_content')
<div class="container">
    <div class="row col-md-8">
        <div class="modal-body">
            <h3>Cập nhật giỏ hàng</h3>
            <form action="{{route('cart.update',[$lsp->id])}}" method="post" enctype="multipart/form-data">
              @method('PATCH')
              @csrf
                <div class="form-group">
                  <label for="exampleInputEmail1">Id hóa đơn</label>
                  <input type="text" class="form-control" name="id_hd" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$lsp->hd_id}}">
                  @error('id_hd')
                    {{$message}}
                  @enderror
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Tên sản phẩm</label>
                  <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$lsp->name}}">
                  @error('name')
                    {{$message}}
                  @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Số lượng</label>
                    @error('soluong')
                      {{$message}}
                    @enderror
                    <input type="text" class="form-control" name="soluong" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$lsp->soluong}}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tổng tiền</label>
                    @error('tongtien')
                      {{$message}}
                    @enderror
                    <input type="text" class="form-control" name="tongtien" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$lsp->sum}}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Trạng thái</label>
                    <input type="text" class="form-control" name="status" id="exampleFormControlFile1" value="{{$lsp->status}}">
                    @error('status')
                    {{$message}}
                    @enderror
                  </div>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
              </form>
          </div>
    </div>
</div>
@endsection