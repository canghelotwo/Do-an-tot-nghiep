<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\deletephoto;
use DB;
use Session;
use File; 
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class VaccineController extends Controller
{
    //hiển thị danh sách vaccine
    public function all_vaccine()
    {
        $all_vaccine = DB::table('vaccines')->paginate(6);
        return view('admin.vaccine.index')->with('all_vaccine',$all_vaccine);
    }
    //thêm vaccine
    public function add_vaccine()
    {
        return view('admin.vaccine.add');
    }
    //lưu vaccine vào data
    public function save_vaccine(Request $request){
        $data = array();
        $data['tenVaccine'] = $request->name;
        $data['soLuong'] = $request->sl;
        if($data){
            DB::table('vaccines')->insert($data);
            Session::put('message','Thêm Vaccine Thành Công');
            return Redirect::to('admin/vaccine');
        }
        else{    
            Session::put('message','Thêm Vaccine Không Thành Công');
            return Redirect::to('admin/vaccine'); 
        }
    }
    //edit vaccine
    public function edit_vaccine($vaccine_id)
    {
        $edit_vaccine = DB::table('vaccines')->where('id',$vaccine_id)->get();
        return view('admin.vaccine.edit')->with('edit_vaccine',$edit_vaccine);
    }
    //update vaccine
    public function update_vaccine(Request $request,$vaccine_id){
       
        $data = array();
        $data['tenVaccine'] = $request->name;
        $data['soLuong'] = $request->sl;

        if($data){
            DB::table('vaccines')->where('id',$vaccine_id)->update($data);
            Session::put('message','Đã Sửa thành công');
            return Redirect::to('admin/vaccine');
        }
        DB::table('vaccines')->where('id',$vaccine_id)->update($data);
        Session::put('message','Sửa không thành công');
        return Redirect::to('admin/vaccine');
    }
    //xóa vaccine
    public function delete_vaccine($vaccine_id)
    {
        DB::table('vaccines')->where('id',$vaccine_id)->delete();
        Session::put('message','Xóa thành công');
        return Redirect::to('admin/vaccine');
    }
}
