@extends('admin.master.dashboard')
@section('main_content')
<div class="container">
    <div class="row col-md-8">
        <div class="modal-body">
            <h3>{{__('msg.ProductUpdate')}}</h3>
            <form action="{{route('product.update',[$lsp->id])}}" method="post" enctype="multipart/form-data">
              @method('PATCH')
              @csrf
              <div class="form-group">
                <label for="exampleInputEmail1">{{__('msg.ProductName')}}</label>
                <input type="text" class="form-control" name="name" value="{{$lsp->name}}" id="exampleInputEmail1" aria-describedby="emailHelp">
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
                <option value="{{$lsp->id}}" selected="selected" >{{$lsp->loaisanpham->name}}</option>    
                  @foreach ($list_lsp as $item)
                  <option value="{{$item->id}}">{{$item->loaisanpham->name}}</option>    
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                  <label for="exampleInputEmail1">{{__('msg.Price')}}</label>
                  @error('price')
                    {{$message}}
                  @enderror
                  <input type="text" class="form-control" value="{{$lsp->price}}" name="price" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">{{__('msg.Amount')}}</label>
                  @error('soluong')
                    {{$message}}
                  @enderror
                  <input type="text" class="form-control" value="{{$lsp->soluong}}" name="soluong" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                  <label for="exampleFormControlFile1">{{__('msg.Image')}}</label>
                  @error('img')
                    {{$message}}
                  @enderror
                  <input type="file" class="form-control-file" src="{{$lsp->img}}" name="img" id="exampleFormControlFile1">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">{{__('msg.Infomation')}}</label>
                  <textarea id="edittor_pr" name="thongtin" class="form-control"id="" cols="30" rows="10">{{$lsp->thongtin}}</textarea>
                  @error('thongtin')
                    {{$message}}
                  @enderror
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">{{__('msg.Description')}}</label>
                  <textarea name="desc"  class="form-control" id="edittor_desc" cols="30" rows="10">{{$lsp->desc}}</textarea>
                  @error('desc')
                  {{$message}}
                  @enderror
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">{{__('msg.Coupe')}}</label>
                  <input type="text" class="form-control" value="{{$lsp->coupe}}" name="coupe" id="exampleFormControlFile1">
                  @error('coupe')
                  {{$message}}
                  @enderror
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">{{__('msg.SaleRate')}}</label>
                  <input type="text" class="form-control" value="{{$lsp->sale}}" name="sale" id="exampleFormControlFile1">
                  @error('sale')
                  {{$message}}
                  @enderror
                </div>
              <button type="submit" class="btn btn-primary">{{__('msg.Update')}}</button>
            </form>
          </div>
    </div>
</div>

@endsection