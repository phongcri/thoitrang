<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect; //trả về nếu thành công or thất bại
session_start();

class CategoryProduct extends Controller
{
    public function add_category_product(){
        return view('admin.add_Category_Product');
    }
    public function all_category_product(){
        $all_category_product = DB::table('tbl_category_product')->get();
        $manager_category_product = view('admin.all_Category_Product')->with('all_category_product', $all_category_product);
        return view('admin_layout')->with('admin.all_Category_Product',$manager_category_product);
    }


    public function save_category_product(Request $request){
       $data = array();
       $data['category_name'] = $request->category_product_name;
       $data['category_desc'] = $request->category_product_desc;
       $data['category_status'] = $request->category_product_status;

    //    echo '<pre>';
    //    print_r ($data);
    //    echo '</pre>';
        DB::table('tbl_category_product')->insert($data);
        Session::put('message', 'Thêm thành công');
        return Redirect::to('add-Category-Product');
    }


    public function unactive_category_product($category_product_id){
        DB::table('tbl_category_product')->where('category_id', $category_product_id)->update(['category_status'=> 0]);
        Session::put('message', 'Tắt kích hoạt được danh mục!!!');
        return Redirect::to('all-Catogory-Product');
       
    }
    public function active_category_product($category_product_id){
        DB::table('tbl_category_product')->where('category_id', $category_product_id)->update(['category_status'=> 1]);
        Session::put('message', 'Kích hoạt được danh mục!!!');
        return Redirect::to('all-Catogory-Product');
    }
}
