<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\loaisanpham;
use App\Models\xeploai;
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
                $output .= '</tr>';

            } 
            echo $output;
       }
    }
    public function searchxeploai(Request $request){

        if($request->get('query'))
        {
           
            
            $query = $request->get('query');
            $data = DB::table('products')
            ->where('name', 'LIKE', "%{$query}%")
            ->get();
             foreach($data as $row)
            {
                $name_loai_sp = loaisanpham::find($row->id_loaisp);
                $xeploai = xeploai::find($row->id);
                $output = '<tr>';
                $output .=  '<th>'.$row->id.'</th>';
                $output .=  '<td>'.$name_loai_sp->name.'</td>';
                $output .=  '<td>'.$row->name.'</td>';
                $output .=  '<td>'.$row->price.'</td>';
                $output .=  '<td>'.$xeploai->level.'</td>';
                $output .= '</tr>';

            } 
            echo $output;
       }
    }
}
