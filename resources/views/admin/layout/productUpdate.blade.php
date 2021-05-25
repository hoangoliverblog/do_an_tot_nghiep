@extends('admin.master.dashboard')
@section('main_content')
<div class="container">
    <div class="row col-md-8">
        <div class="modal-body">
            <h3>Cập nhật sản phẩm</h3>
            <form action="{{route('product.update',[$lsp->id])}}" method="post" enctype="multipart/form-data">
              @method('PATCH')
              @csrf
              <div class="form-group">
                <label for="exampleInputEmail1">Tên sản phẩm</label>
                <input type="text" class="form-control" name="name" value="{{$lsp->name}}" id="exampleInputEmail1" aria-describedby="emailHelp">
                @error('name')
                  {{$message}}
                @enderror
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Loại sản phẩm</label>
                @error('id_loaisp')
                  {{$message}}
                @enderror
                <select name="id_loaisp" id="id_loaisp" class="form-control" id="exampleFormControlSelect1">
                <option value="{{$lsp->id}}" selected="selected" >{{$lsp->loaisanpham->name}}</option>    
                  @foreach ($list_lsp as $item)
                  <option value="{{$item->id}}">{{$item->loaisanpham->name}}</option>    
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                  <label for="exampleInputEmail1">Giá</label>
                  @error('price')
                    {{$message}}
                  @enderror
                  <input type="text" class="form-control" value="{{$lsp->price}}" name="price" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Số lượng</label>
                  @error('soluong')
                    {{$message}}
                  @enderror
                  <input type="text" class="form-control" value="{{$lsp->soluong}}" name="soluong" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                  <label for="exampleFormControlFile1">Ảnh</label>
                  @error('img')
                    {{$message}}
                  @enderror
                  <input type="file" class="form-control-file" src="{{$lsp->img}}" name="img" id="exampleFormControlFile1">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Thông tin</label>
                  <textarea id="edittor_pr" name="thongtin" class="form-control"id="" cols="30" rows="10">{{$lsp->thongtin}}</textarea>
                  @error('thongtin')
                    {{$message}}
                  @enderror
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Mô tả</label>
                  <textarea name="desc"  class="form-control" id="edittor_desc" cols="30" rows="10">{{$lsp->desc}}</textarea>
                  @error('desc')
                  {{$message}}
                  @enderror
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Mã giảm giá</label>
                  <input type="text" class="form-control" value="{{$lsp->coupe}}" name="coupe" id="exampleFormControlFile1">
                  @error('coupe')
                  {{$message}}
                  @enderror
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Tỷ lệ sale</label>
                  <input type="text" class="form-control" value="{{$lsp->sale}}" name="sale" id="exampleFormControlFile1">
                  @error('sale')
                  {{$message}}
                  @enderror
                </div>
              <button type="submit" class="btn btn-primary">Cập nhật</button>
            </form>
          </div>
    </div>
</div>

@endsection