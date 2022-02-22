<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\deletephoto;
use DB;
use Session;
use File; 
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //hiển thị danh sách tài khoản
    public function all_user(){
        $all_role = DB::table('roles')->get();
        $all_user = DB::table('users')->paginate(6);
        return view('admin.taikhoan.index')->with('all_role',$all_role)->with('all_user',$all_user);

    }
    //thêm tài khoản
    public function add_user()
    {
    	$all_role = DB::table('roles')->get();
        return view('admin.taikhoan.add')->with('all_role',$all_role);
    }
    //lưu tài khoản vào data
    public function save_user(Request $request){
        $data = array();
        $data['name'] = $request->name;
        $data['gioiTinh'] = "";
        $data['SDT'] = $request->sdt;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->pass);
        $data['diaChi'] = "";
        $data['role_id'] = $request->role_id;
        if($data){
            DB::table('users')->insert($data);
            Session::put('message','Thêm Tài Khoản Thành Công');
            return Redirect::to('admin/account');
        }
        else{    
            Session::put('message','Thêm Tài Khoản Không Thành Công');
            return Redirect::to('admin/account'); 
        }
    }
    //edit tài khoản
    public function edit_user($user_id)
    {
    	$all_role = DB::table('roles')->get();
        $edit_user = DB::table('users')->where('id',$user_id)->get();
        return view('admin.taikhoan.edit')->with('edit_user',$edit_user)->with('all_role',$all_role);
    }
    //update tài khoản
    public function update_user(Request $request,$user_id){
       
        $data = array();
        $data['name'] = $request->name;
        $data['gioiTinh'] ="";
        $data['SDT'] = $request->sdt;
        $data['email'] = $request->email;
        $data['diaChi'] = "";
        $data['role_id'] = $request->role_id;

        if($data){
            DB::table('users')->where('id',$user_id)->update($data);
            Session::put('message','Đã Sửa thành công');
            return Redirect::to('admin/account');
        }
        DB::table('users')->where('id',$user_id)->update($data);
        Session::put('message','Sửa không thành công');
        return Redirect::to('admin/account');
    }
    //xóa tài khoản
    public function delete_user($user_id)
    {
        DB::table('users')->where('id',$user_id)->delete();
        Session::put('message','Xóa Tài Khoản thành công');
        return Redirect::to('admin/account');
    }
    //đăng ký tài khoản
    public function create_user(Request $request)
    {
        if ($request->password == $request->rspassword) {
           $data = array();
            $data['name'] = $request->name;
            $data['SDT'] = $request->sdt;
            $data['gioiTinh'] = '';
            $data['email'] = $request->email;
            $data['diaChi'] = '';
            $data['password'] = Hash::make($request->password);
            $data['role_id'] = 2;
            if($data){
                DB::table('users')->insert($data);
                Session::put('message-login','Đăng ký tài khoản thành công');
                return Redirect::to('/dangnhap');
            }
            else{ 
                return Redirect::to('/dangky'); 
            }
        }
        else
        {
            return Redirect::to('/dangky'); 
        }
        
    }
}
