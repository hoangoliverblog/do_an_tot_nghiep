<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\loaisanpham;
use App\Models\Comment;
use App\Models\Product;
use App\Models\xeploai;
use App\User;
class ajaxController extends Controller
{
    public function searchuser(Request $request){

        if($request->get('query'))
        {
            $query = $request->get('query');
            $data = DB::table('users')
            ->where('name', 'LIKE', "%{$query}%")
            ->get();
             foreach($data as $row)
            {
                $output = '<tr>';
                $u = $row->role_id == 1 ? 'admin' : 'user';
                $output .=  '<th>'.$row->id.'</th>';
                $output .=  '<td>'.$row->name.'</td>';
                $output .=  '<td>'.$row->email.'</td>';
                $output .=  '<td>'.$row->role_id.'</td>';
                $output .=  '<td>'.$row->address.'</td>';
                $output .=  '<td>'.$row->phone.'</td>';
                $output .=  '<td>'.$row->gioitinh.'</td>';
                $output .=  '<td>'.$row->status.'</td>';
                $output .=  '<td>'.$row->created_at.'</td>';
                $output .=  '<td>'."<span><a onclick='return edit()' href=".route('user.show',[$row->id])."><i class='fas fa-edit'></i></a></span>"
                            ."<form action=".route('user.destroy',[$row->id])." method='POST' onsubmit='return xoa()'>"
                            ."<input type='hidden' name='_token' value='rJs3wkmON0OHvDKiTWS6WQbNAUf5bRUOEwJ7MOVX'>"
                            ."<input type='hidden' name='_method' value='DELETE'>"
                            ."<button type='submit'><span><a href=''><i class='fas fa-trash-alt'></i></a></span></button>"
                            ."</form>"
                            ."</td>";
                $output .= '</tr>';

            }
            
            echo $output;
       }
    }

    public function searchproduct(Request $request){

        if($request->get('query'))
        {
            
            $query = $request->get('query');
            $data = DB::table('products')
            ->where('name', 'LIKE', "%{$query}%")
            ->get();
             foreach($data as $row)
            {
                $name_loai_sp = loaisanpham::find($row->id_loaisp)->name;

                $output = '<tr>';
                $output .=  '<th>'.$row->id.'</th>';
                $output .=  '<td>'.$row->name.'</td>';
                $output .=  '<td>'.$name_loai_sp.'</td>';
                $output .=  '<td>'.$row->price.'</td>';
                $output .=  '<td>'.$row->soluong.'</td>';
                $output .=  '<td>'.$row->img.'</td>';
                $output .=  '<td>'.$row->thongtin.'</td>';
                $output .=  '<td>'.$row->desc.'</td>';
                $output .=  '<td>'.$row->coupe.'</td>';
                $output .=  '<td>'.$row->sale.'</td>';
                $output .=  '<td>'.$row->created_at.'</td>';
                $output .=  '<td>'
                            ."<span><a onclick='return edit()' href=".route('product.show',[$row->id])."><i class='fas fa-edit'></i></a></span>"
                            ."<form action=".route('product.destroy',[$row->id])." method='POST' onsubmit='return xoa()'>"
                            ."<input type='hidden' name='_token' value='rJs3wkmON0OHvDKiTWS6WQbNAUf5bRUOEwJ7MOVX'>"
                            ."<input type='hidden' name='_method' value='DELETE'>"
                            ."<button type='submit'><span><a href=''><i class='fas fa-trash-alt'></i></a></span></button>"
                            ."</form>"
                            .'</td>';
                $output .= '</tr>';

            } 
            echo $output;
       }
    }
    public function searchxeploai(Request $request){

    //     if($request->get('query'))
    //     {
           
            
    //         $query = $request->get('query');
    //         $data = DB::table('products')
    //         ->where('name', 'LIKE', "%{$query}%")
    //         ->get();
    //          foreach($data as $row)
    //         {
    //             $name_loai_sp = loaisanpham::find($row->id_loaisp);
    //             $xeploai = xeploai::find($row->id);
    //             $output = '<tr>';
    //             $output .=  '<th>'.$row->id.'</th>';
    //             $output .=  '<td>'.$name_loai_sp->name.'</td>';
    //             $output .=  '<td>'.$row->name.'</td>';
    //             $output .=  '<td>'.$row->price.'</td>';
    //             $output .=  '<td>'.$xeploai->level.'</td>';
    //             $output .= '</tr>';

    //         } 
    //         echo $output;
    //    }
    }
    public function searchcomment(Request $request){

        if($request->get('query'))
        {
           
            
            $query = $request->get('query');
            $data = DB::table('comments')
            ->where('content', 'LIKE', "%{$query}%")
            ->get();
             foreach($data as $row)
            {
                $user = User::find($row->user_id);
                $pr = Product::find($row->pr_id);

                $output = '<tr>';
                $output .=  '<th>'.$row->id.'</th>';
                $output .=  '<td>'.$user->email.'</td>';
                $output .=  '<td>'.$user->name.'</td>';
                $output .=  '<td>'.$pr->loaisanpham->name.'</td>';
                $output .=  '<td>'.$pr->name.'</td>';
                $output .=  '<td>'.$row->content.'</td>';
                $output .=  '<td>'.$row->created_at.'</td>';
                $output .=  '<td>'
                            ."<form action=".route('chitiethoadon.destroy',[$row->id])." method='POST' onsubmit='return xoa()'>"
                            ."<input type='hidden' name='_token' value='rJs3wkmON0OHvDKiTWS6WQbNAUf5bRUOEwJ7MOVX'>"
                            ."<input type='hidden' name='_method' value='DELETE'>"
                            ."<button type='submit'><span><a href=''><i class='fas fa-trash-alt'></i></a></span></button>"
                            ."</form>"
                            .'</td>';
                $output .= '</tr>';

            } 
            echo $output;
       }
    }
    public function searchhoadon(Request $request){

        if($request->get('query'))
        {
           
            
            $query = $request->get('query');
            $data = DB::table('hoadons')
            ->where('id', 'LIKE', "%{$query}%")
            ->get();
             foreach($data as $row)
            {
                $user = User::find($row->user_id);
                $pr = Product::find($row->pr_id);
                $output = '<tr>';
                $output .=  '<th>'.$row->id.'</th>';
                $output .=  '<td>'.$user->name.'</td>';
                $output .=  '<td>'.$pr->name.'</td>';
                $output .=  '<td>'.$user->role_user->role_name.'</td>';
                $output .=  '<td>'.$user->address.'</td>';
                $output .=  '<td>'.$user->phone.'</td>';
                $output .=  '<td>'.$sum = $pr->price * $pr->soluong.'</td>';
                $output .=  '<td>'.$row->created_at.'</td>';
                $output .=  '<td>'
                            ."<form action=".route('hoadon.destroy',[$row->id])." method='POST' onsubmit='return xoa()'>"
                            ."<input type='hidden' name='_token' value='rJs3wkmON0OHvDKiTWS6WQbNAUf5bRUOEwJ7MOVX'>"
                            ."<input type='hidden' name='_method' value='DELETE'>"
                            ."<button type='submit'><span><a href=''><i class='fas fa-trash-alt'></i></a></span></button>"
                            ."</form>"
                            .'</td>';
                $output .= '</tr>';

            } 
            echo $output;
       }
    }
}
