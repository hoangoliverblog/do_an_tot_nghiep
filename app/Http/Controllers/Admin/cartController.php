<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use DateTime;
class cartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = Cart::paginate(7);
        $user = Auth::user();
        
        return view('admin.layout.cart',['lus'=>$cart,'user'=>$user]);
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
       
        if ($request->isMethod('post')) {
            $validator = Validator::make(
                $request->all(),
                [
                    'id_hd'  => 'required|min:1|numeric',
                    'name' => 'required',
                    'tongtien' => 'required|min:4|max:100000000|numeric',
                    'soluong' => 'required|numeric',
                    'status'  => 'required'
                ],
                [
                    'id_hd.required' => 'Id hóa đơn không được để trống',
                    'id_hd.min' => 'Id hóa đơn lớn hơn 3 kí tự',
                    'id_hd.numeric' => 'Id hóa đơn là kiểu chữ số',
                    'name.required' => 'Tên sản phẩm không được để trống',
                    'tongtien.required' => 'Tổng tiền không được để trống',
                    'tongtien.numeric' => 'Tổng tiền có định dạng là chữ số',
                    'tongtien.min' => 'Tổng tiền lớn hơn 1000',
                    'tongtien.max' => 'Tổng tiền nhỏ hơn 1 tỷ đồng',
                    'soluong.required' => 'Nhập số lượng sản phẩm ko được trống',
                    'soluong.numeric' => 'Số lượng có định dạng là kiểu chữ số',
                    'status.required' => 'Trạng thái đơn hàng không được trống'
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            } else {

                DB::table('carts')->insert([
                    'hd_id' => $request->id_hd,
                    'name' => $request->name,
                    'soluong' => $request->soluong,
                    'sum' => $request->tongtien,
                    'status' => $request->status ?: 'chưa thanh toán',
                    'created_at' => new DateTime()
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
        $lsp = Cart::find($id);
        $list_lsp = Product::all();
        return view('admin.layout.cartUpdate', ['lsp' => $lsp, 'user' => $user, 'list_lsp' => $list_lsp]);
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
        if ($request->isMethod('patch')) {

            $validator = Validator::make(
                $request->all(),
                [
                    'id_hd'  => 'required|min:1|numeric',
                    'name' => 'required',
                    'tongtien' => 'required|min:4|max:100000000|numeric',
                    'soluong' => 'required|numeric',
                    'status'  => 'required'
                ],
                [
                    'id_hd.required' => 'Id hóa đơn không được để trống',
                    'id_hd.min' => 'Id hóa đơn lớn hơn 3 kí tự',
                    'id_hd.numeric' => 'Id hóa đơn là kiểu chữ số',
                    'name.required' => 'Tên sản phẩm không được để trống',
                    'tongtien.required' => 'Tổng tiền không được để trống',
                    'tongtien.numeric' => 'Tổng tiền có định dạng là chữ số',
                    'tongtien.min' => 'Tổng tiền lớn hơn 1000',
                    'tongtien.max' => 'Tổng tiền nhỏ hơn 1 tỷ đồng',
                    'soluong.required' => 'Nhập số lượng sản phẩm ko được trống',
                    'soluong.numeric' => 'Số lượng có định dạng là kiểu chữ số',
                    'status.required' => 'Trạng thái đơn hàng không được trống'
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            } else {
                DB::table('carts')->where('id', $id)->update([
                    'hd_id' => $request->id_hd,
                    'name' => $request->name,
                    'soluong' => $request->soluong,
                    'sum' => $request->tongtien,
                    'status' => $request->status ?: 'chưa thanh toán',
                    'updated_at' => new DateTime()
                ]);
                return redirect()->route('cart.index');
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
        cart::where('id',$id)->delete();
        return redirect()->back();
    }
}
