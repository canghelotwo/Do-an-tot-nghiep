<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\deletephoto;
use DB;
use Session;
use File; 
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class LieutrinhController extends Controller
{
    //hiển thị danh sách liệu trình
    public function all_lieutrinh(){
        $all_vaccine = DB::table('vaccines')->get();
        $all_lieutrinh = DB::table('lieutrinh')->paginate(8);
        return view('admin.lieutrinh.index')->with('all_lieutrinh',$all_lieutrinh)->with('all_vaccine',$all_vaccine);

    }
    //thêm liệu trình cho vaccine
    public function add_lieutrinh()
    {
    	$all_vaccine = DB::table('vaccines')->get();
    	$all_lieutrinh = DB::table('lieutrinh')->get();
        return view('admin.lieutrinh.add')->with('all_lieutrinh',$all_lieutrinh)->with('all_vaccine',$all_vaccine);
    }
    //lưu liệu trình vào data
    public function save_lieutrinh(Request $request){
        $data = array();
        $data['thangTuoi'] = $request->thangtuoi;
        $data['muiTT'] = $request->muitt;
        $data['vaccine_id'] = $request->vaccine_id;
        if($data){
            DB::table('lieutrinh')->insert($data);
            Session::put('message','Thêm Thành Công');
            return Redirect::to('admin/lieutrinh');
        }
        else{    
            Session::put('message','Thêm Không Thành Công');
            return Redirect::to('admin/lieutrinh'); 
        }
    }
    //edit liệu trình
    public function edit_lieutrinh($lieutrinh_id)
    {
    	$all_vaccine = DB::table('vaccines')->get();
        $edit_lieutrinh = DB::table('lieutrinh')->where('id',$lieutrinh_id)->get();
        return view('admin.lieutrinh.edit')->with('edit_lieutrinh',$edit_lieutrinh)->with('all_vaccine',$all_vaccine);
    }
    //update liệu trình
    public function update_lieutrinh(Request $request,$lieutrinh_id){
       
        $data = array();
        $data['thangTuoi'] = $request->thangtuoi;
        $data['muiTT'] = $request->muitt;
        $data['vaccine_id'] = $request->vaccine_id;

        if($data){
            DB::table('lieutrinh')->where('id',$lieutrinh_id)->update($data);
            Session::put('message','Đã Sửa thành công');
            return Redirect::to('admin/lieutrinh');
        }
        DB::table('lieutrinh')->where('id',$lieutrinh_id)->update($data);
        Session::put('message','Sửa không thành công');
        return Redirect::to('admin/lieutrinh');
    }
    //xóa liệu trình
    public function delete_lieutrinh($lieutrinh_id)
    {
        DB::table('lieutrinh')->where('id',$lieutrinh_id)->delete();
        Session::put('message','Xóa thành công');
        return Redirect::to('admin/lieutrinh');
    }
}