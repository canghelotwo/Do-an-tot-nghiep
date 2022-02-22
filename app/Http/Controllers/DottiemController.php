<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\deletephoto;
use DB;
use Session;
use File; 
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class DottiemController extends Controller
{
    //hiển thị danh sách lịch tiêm
    public function all_dottiem()
    {
        $phuongxa = DB::table('phuongxa')->get();
        $all_dottiem = DB::table('dottiem')->paginate(6);
        return view('admin.dottiem.index')->with('all_dottiem',$all_dottiem)->with('phuongxa',$phuongxa);
    }
    //thêm tài khoản
    public function add_dottiem()
    {
    	$phuongxa = DB::table('phuongxa')->get();
        return view('admin.dottiem.add')->with('phuongxa',$phuongxa);
    }
    //lưu tài khoản vào data
    public function save_dottiem(Request $request){
        $data = array();
        $data['tenDiaDiem'] = $request->diadiem;
        $data['ngayBD'] = $request->ngaybd;
        $data['ngayKT'] = $request->ngaykt;
        $data['phuongxa_id'] = $request->phuongxa_id;
        if($data){
            DB::table('dottiem')->insert($data);
            Session::put('message','Thêm Thành Công');
            return Redirect::to('admin/dottiem');
        }
        else{    
            Session::put('message','Thêm Không Thành Công');
            return Redirect::to('admin/dottiem'); 
        }
    }
    //edit tài khoản
    public function edit_dottiem($dottiem_id)
    {
    	$phuongxa = DB::table('phuongxa')->get();
        $edit_dottiem = DB::table('dottiem')->where('id',$dottiem_id)->get();
        return view('admin.dottiem.edit')->with('edit_dottiem',$edit_dottiem)->with('phuongxa',$phuongxa);
    }
    //update tài khoản
    public function update_dottiem(Request $request,$dottiem_id){
       
        $data = array();
        $data['tenDiaDiem'] = $request->diadiem;
        $data['ngayBD'] = $request->ngaybd;
        $data['ngayKT'] = $request->ngaykt;
        $data['phuongxa_id'] = $request->phuongxa_id;

        if($data){
            DB::table('dottiem')->where('id',$dottiem_id)->update($data);
            Session::put('message','Đã Sửa thành công');
            return Redirect::to('admin/dottiem');
        }
        DB::table('dottiem')->where('id',$dottiem_id)->update($data);
        Session::put('message','Sửa không thành công');
        return Redirect::to('admin/dottiem');
    }
    //xóa tài khoản
    public function delete_dottiem($dottiem_id)
    {
        DB::table('dottiem')->where('id',$dottiem_id)->delete();
        Session::put('message','Xóa thành công');
        return Redirect::to('admin/dottiem');
    }
}
