<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class productController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lus = Product::paginate(10);
        $user = Auth::user();
        
        $lsp = DB::table('loaisanphams')->get();

        return view('admin.layout.product',['lus'=>$lus,'user'=>$user,'lsp'=>$lsp]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        if($request->isMethod('post'))
        {
            $validator = Validator::make($request->all(),[
                'name'  => 'required|min:3|max:30',
                'id_loaisp'=>'required',
                'price'=> 'required|min:4|max:10',
                'soluong'=>'required',
            ],
            [
                'name.required'=>'Tên sản phẩm không được để trống',
                'name.min'=>'Tên người dùng lớn hơn 3 kí tự',
                'name.max'=>'Tên người dùng ngắn hơn 30 kí tự',
                'id_loaisp.required'=>'Chọn một loại sản phẩm thích hợp',
                'price.required'=>'Giá sản phẩm không được để trống',
                'price.min'=>'Giá sản phẩm lớn hơn 1000 vnđ',
                'price.max'=>'Giá sản phẩm nhỏ hơn 1 tỷ đồng',
                'soluong.required'=>'Nhập số lượng sản phẩm'
            ]);
                
            if($validator->fails()){
                return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
            }else
            {
                $name = $this->uploadimg($request,'img');
              DB::table('products')->insert([
                  'name'=>$request->name,
                  'id_loaisp'=>$request->id_loaisp,
                  'price'=>$request->price,
                  'soluong'=>$request->soluong,
                  'img'=>$name ?: 'trong',
                  'thongtin'=>$request->thongtin ?: 'trong',
                  'desc'=>$request->desc ?: 'trong',
                  'coupe'=>$request->coupe ?: 'trong',
                  'sale'=>$request->sale ?: 0,
                  'created_at'=> new DateTime()
              ]);
             return redirect()->back();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $lsp = Product::find($id);
        $list_lsp = Product::all();
        return view('admin.layout.productUpdate',['lsp'=>$lsp,'user'=>$user,'list_lsp'=>$list_lsp]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->isMethod('patch'))
        {
            
            $validator = Validator::make($request->all(),[
                'name'  => 'required|min:3|max:30',
            ],
            [
                'name.required'=>'Tên người dùng không được để trống',
                'name.min'=>'Tên người dùng lớn hơn 3 kí tự',
                'name.max'=>'Tên người dùng ngắn hơn 30 kí tự',
            ]);

            if($validator->fails()){
                return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
            }
            else
            {      
                
                $name = $this->uploadimg($request,'img',$id);
                DB::table('products')->where('id',$id)->update([
                  'name'=>$request->name,
                  'id_loaisp'=>$request->id_loaisp,
                  'price'=>$request->price,
                  'soluong'=>$request->soluong,
                  'img'=>$name ,
                  'thongtin'=>$request->thongtin ?: 'trong',
                  'desc'=>$request->desc ?: 'trong',
                  'coupe'=>$request->coupe ?: 'trong',
                  'sale'=>$request->sale ?: 0,
                  'updated_at'=> new DateTime()
                ]);
               return redirect() ->route('product.index');    
            }
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::where('id',$id)->delete();
        return redirect()->back();
    }

}
