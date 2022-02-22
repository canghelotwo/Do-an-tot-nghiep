<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\deletephoto;
use DB;
use Session;
use File; 
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Excel;
use App\Exports\TestExport;
use App\DangKyTiem;

class LichtiemController extends Controller
{
    //hiển thị danh sách lịch tiêm  
    public function all_lichtiem(Request $request){

        $dottiems = DB::table('dottiem')->get();
        $getday = date('Y-m-d');
        $vaccines = DB::table('vaccines')->get();
        $nghs = DB::table('guardians')->get();
        $kids = DB::table('kids')->get();
        $dt_id = $request->dottiem;
        $tt = $request->tt;
        if ($request->all() != []) {
            $dkts = DB::table('dangkytiem')->where('dottiem_id',$request->dottiem)->where('TinhTrang',$request->tt)->get();
            return view('admin.lichtiem.index')->with('dkts',$dkts)->with('dottiems',$dottiems)->with('vaccines',$vaccines)->with('nghs',$nghs)->with('kids',$kids)->with('dt_id',$dt_id)->with('tt',$tt);
        }
        else
        {
            $dkts = DB::table('dangkytiem')->get();
            return view('admin.lichtiem.index')->with('dkts',$dkts)->with('dottiems',$dottiems)->with('vaccines',$vaccines)->with('nghs',$nghs)->with('kids',$kids)->with('dt_id',$dt_id)->with('tt',$tt);
        }
        // $all_lichtiem = DB::table('dangkytiem')->paginate(4);
        // return view('admin.lichtiem.index')->with('all_lichtiem',$all_lichtiem);

    }

    public function Export($id)
    {
        return Excel::download(new TestExport($id),'danhsachdktc.xlsx');
    }
}
