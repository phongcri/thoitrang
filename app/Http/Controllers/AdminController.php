<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect; //trả về nếu thành công or thất bại
session_start();

class AdminController extends Controller
{
    public function index(){
       return view('admin_login');
    }
    public function show_dashboard(){
        return view('admin.dashboard');
     }
     public function dashboard(Request $request){
        $admin_email = $request ->Email;
        $admin_password = MD5($request -> Password);

        $result = DB::table('tbl_admin') ->where('admin_email', $admin_email)-> where('admin_password',$admin_password)->first();

        if($result){
         Session::put('admin_name', $result->admin_name);
         Session::put('admin_id', $result->admin_id);
         return Redirect::to('/dashboard');
        }else{
         Session::put('message', "Tài khoản hoặc mật khẩu không chính xác, vui lòng nhập lại!!!");
         return Redirect::to('/admin');
        }
      //   echo '<pre>';
      //   print_r($result);
      //   echo '</pre>';
      //   return view('admin.dashboard');
     }

     public function logout(){
      // echo 'logout thành công';
      Session::put('admin_name', null);
      Session::put('admin_id', null);
      return Redirect::to('/admin');
   }
}
