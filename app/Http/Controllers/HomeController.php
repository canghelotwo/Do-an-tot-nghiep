<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use File; 
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Menu\CreateFormRequest;
use App\User;
use Illuminate\Support\Facades\Hash;
use Nexmo\Client\Credentials\Basic;
use Nexmo\Client;
use Nexmo\Client\Exception\Request as NexmoExceptionRequest;
use Log;
use Nexmo\Laravel\Facade\Nexmo;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        return view('Page.home');

    }
    public function login()
    {
        return view('Page.login');
    }

    public function login_user(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email:filter',
            'password' => 'required'
        ],[
            'email.required'=>'Email không được để trống',
            'password.required'=>'password không được để trống',
        ]);


        if (Auth::attempt([
                'email' => $request->input('email'),
                'password' => $request->input('password')
            ], $request->input('remember'))) {

            return redirect()->route('home');
        }

        Session::put('message-login', 'Email hoặc Mật khẩu không đúng');
        return redirect()->back();
    }
    public function logout_user()
    {
        Auth::logout();
        return redirect(route('dangnhap'));
    }

    public function registration()
    {
        return view('Page.registration');
    }
    public function dangkytiemchung()
    {
        $getday = date('Y-m-d');
        $vaccine = DB::table('vaccines')->get();
        $dottiem = DB::table('dottiem')->where('ngayBD','>',$getday)->get();
        $px = DB::table('phuongxa')->get();
        $qh = DB::table('quanhuyen')->get();

        return view('Page.dangkytiem')->with('vaccine',$vaccine)->with('dottiem',$dottiem)->with('px',$px)->with('qh',$qh);
    }

    public function profile()
    {
        return view('Page.profile');
    }
    public function updatepassword()
    {
        return view('Page.updatepassword');
    }
    public function update_profile(Request $request,$user_id)
    {
        $data = array();
        $data['name'] = $request->name;
        $data['SDT'] = $request->sdt;

        if($data){
            DB::table('users')->where('id',$user_id)->update($data);
            Session::put('message-profile','Cập nhật thông tin thành công');
            return Redirect::to('/profile');
        }
        DB::table('users')->where('id',$user_id)->update($data);
        Session::put('message-profile','Cập nhật thông tin không thành công');
        return Redirect::to('/profile');
    }
    public function update_password(Request $request,$user_id)
    {

        if ($request->password == $request->rspassword) {
            $data = array();
            $data['password'] = Hash::make($request->password);
            if($data){
                DB::table('users')->where('id',$user_id)->update($data);
                Session::put('message-password','Cập nhật thông tin thành công');
                return Redirect::to('/profile');
            }
            DB::table('users')->where('id',$user_id)->update($data);
            Session::put('message-password','Cập nhật thông tin không thành công');
            return Redirect::to('/profile');
        }
        else
        {
            Session::put('message-password','Mật khẩu nhập vào không khớp nhau!');
            return Redirect::to('/updatepassword');
        }
    }

    public function dktc_post(Request $request)
    {
        $id_ngh = DB::table('guardians')->insertGetId([
            'tenNGH' => $request->name,
            'moiQH' => $request->mqh,
            'CMND' => $request->cmnd,
            'SDT' => $request->sdt,
        ]);
        $id_kid = DB::table('kids')->insertGetId([
            'name' => $request->nametre,
            'gioiTinh' => $request->gttre,
            'ngaySinh' => $request->ns,
            'soTheBH' => $request->bhyt,
            'nguoigiamho_id' => $id_ngh,
        ]);

        $getdate = date('Y-m-d');
        $data = array();
        $data['vaccine_id'] = $request->vaccine;
        $data['dottiem_id'] = $request->dottiem;
        $data['NgayDK'] = $getdate;
        $data['NgayTiem'] = $getdate;
        $data['kid_id'] = $id_kid;
        $data['TinhTrang'] = 'Đợi Duyệt';
        $data['MuiThu'] =$request->muitt;
        
        if($data){
            $iddkt =  DB::table('dangkytiem')->insertGetId($data);
            $tenVC = DB::select("SELECT vaccines.tenVaccine FROM vaccines JOIN dangkytiem ON dangkytiem.vaccine_id = vaccines.id WHERE dangkytiem.vaccine_id = $request->vaccine AND dangkytiem.id = $iddkt");

            $dottiem = DB::select("SELECT dottiem.* FROM dottiem JOIN dangkytiem ON dangkytiem.dottiem_id = dottiem.id WHERE dangkytiem.dottiem_id = $request->dottiem AND dangkytiem.id = $iddkt");
            $sdt = substr($request->sdt, 1);
            $to = "+84".$sdt;
            $from = getenv("TWILIO_FROM");
            foreach ($tenVC as  $ten) {
                $nameVC = $ten->tenVaccine;
            }
            foreach ($dottiem as $dt) {
                $bt = $dt->ngayBD;
                $kt = $dt->ngayKT;
                $dd = $dt->tenDiaDiem;
            }
            $message = $request->nametre." có mã là ".$id_kid." có lịch tiêm vaccine ".$nameVC." từ ngày ".$bt." đến ngày ".$kt." tại ".$dd." và mã đăng ký của bạn là ".$iddkt;
            //open connection

            $ch = curl_init();

            //set the url, number of POST vars, POST data
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_USERPWD, getenv("TWILIO_SID").':'.getenv("TWILIO_TOKEN"));
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
            curl_setopt($ch, CURLOPT_URL, sprintf('https://api.twilio.com/2010-04-01/Accounts/'.getenv("TWILIO_SID").'/Messages.json', getenv("TWILIO_SID")));
            curl_setopt($ch, CURLOPT_POST, 3);
            curl_setopt($ch, CURLOPT_POSTFIELDS, 'To='.$to.'&From='.$from.'&Body='.$message);

            // execute post
            $result = curl_exec($ch);
            $result = json_decode($result);

            // close connection
            curl_close($ch);
            Session::flash('status','Đăng ký Thành Công! Hệ thống sẽ gửi tin nhắn về cho bạn!');
            return Redirect::to('/');
        }
        else{    
            Session::flash('status','Đăng Ký Không Thành Công');
            return Redirect::to('/dangkytiemchung'); 
        }
        
    }

    public function dktc_coma(Request $request,$kid_id)
    {
        $getdate = date('Y-m-d');
        $data = array();
        $data['vaccine_id'] = $request->vaccine;
        $data['dottiem_id'] = $request->dottiem;
        $data['NgayDK'] = $getdate;
        $data['NgayTiem'] = $getdate;
        $data['kid_id'] = $kid_id;
        $data['TinhTrang'] = 'Đợi Duyệt';
        $data['MuiThu'] =$request->muitt;
        $sdtngh = DB::select("SELECT guardians.SDT FROM guardians JOIN kids ON guardians.id = kids.nguoigiamho_id WHERE kids.id =$kid_id");
        
        if($data){
            $iddkt =  DB::table('dangkytiem')->insertGetId($data);
            $tenVC = DB::select("SELECT vaccines.tenVaccine FROM vaccines JOIN dangkytiem ON dangkytiem.vaccine_id = vaccines.id WHERE dangkytiem.vaccine_id = $request->vaccine AND dangkytiem.id = $iddkt");
            $kid = DB::select("SELECT * FROM kids WHERE id = $kid_id");
            $dottiem = DB::select("SELECT dottiem.* FROM dottiem JOIN dangkytiem ON dangkytiem.dottiem_id = dottiem.id WHERE dangkytiem.dottiem_id = $request->dottiem AND dangkytiem.id = $iddkt");
            foreach ($sdtngh as $sdtt) {
                $sdt = substr($sdtt->SDT, 1);
            }
            $to = "+84".$sdt;
            $from = getenv("TWILIO_FROM");
            foreach ($tenVC as  $ten) {
                $nameVC = $ten->tenVaccine;
            }
            foreach ($kid as $k) {
                $nametre = $k->name;
            }
            foreach ($dottiem as $dt) {
                $bt = $dt->ngayBD;
                $kt = $dt->ngayKT;
                $dd = $dt->tenDiaDiem;
            }
            $message = $nametre." có mã là ".$kid_id." có lịch tiêm vaccine ".$nameVC." từ ngày ".$bt." đến ngày ".$kt." tại ".$dd." và mã đăng ký của bạn là ".$iddkt;
            //open connection

            $ch = curl_init();

            //set the url, number of POST vars, POST data
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_USERPWD, getenv("TWILIO_SID").':'.getenv("TWILIO_TOKEN"));
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
            curl_setopt($ch, CURLOPT_URL, sprintf('https://api.twilio.com/2010-04-01/Accounts/'.getenv("TWILIO_SID").'/Messages.json', getenv("TWILIO_SID")));
            curl_setopt($ch, CURLOPT_POST, 3);
            curl_setopt($ch, CURLOPT_POSTFIELDS, 'To='.$to.'&From='.$from.'&Body='.$message);

            // execute post
            $result = curl_exec($ch);
            $result = json_decode($result);

            // close connection
            curl_close($ch);
            Session::flash('status','Đăng ký Thành Công! Hệ thống sẽ gửi tin nhắn về cho bạn!');
            return Redirect::to('/');
        }
        else{    
            Session::flash('status','Đăng Ký Không Thành Công');
            return Redirect::to('/dangkytiemchungcoma'); 
        }
    }

    public function dktc_post_user(Request $request,$id)
    {
        $id_ngh = DB::table('guardians')->insertGetId([
            'tenNGH' => $request->name,
            'moiQH' => $request->mqh,
            'CMND' => $request->cmnd,
            'SDT' => $request->sdt,
            'user_id' => $id,
        ]);
        $id_kid = DB::table('kids')->insertGetId([
            'name' => $request->nametre,
            'gioiTinh' => $request->gttre,
            'ngaySinh' => $request->ns,
            'soTheBH' => $request->bhyt,
            'nguoigiamho_id' => $id_ngh,
        ]);

        $getdate = date('Y-m-d');
        $data = array();
        $data['vaccine_id'] = $request->vaccine;
        $data['dottiem_id'] = $request->dottiem;
        $data['NgayDK'] = $getdate;
        $data['NgayTiem'] = $getdate;
        $data['kid_id'] = $id_kid;
        $data['TinhTrang'] = 'Đợi Duyệt';
        $data['MuiThu'] =$request->muitt;
        if($data){
            $iddkt =  DB::table('dangkytiem')->insertGetId($data);
            $tenVC = DB::select("SELECT vaccines.tenVaccine FROM vaccines JOIN dangkytiem ON dangkytiem.vaccine_id = vaccines.id WHERE dangkytiem.vaccine_id = $request->vaccine AND dangkytiem.id = $iddkt");

            $dottiem = DB::select("SELECT dottiem.* FROM dottiem JOIN dangkytiem ON dangkytiem.dottiem_id = dottiem.id WHERE dangkytiem.dottiem_id = $request->dottiem AND dangkytiem.id = $iddkt");
            $sdt = substr($request->sdt, 1);
            $to = "+84".$sdt;
            $from = getenv("TWILIO_FROM");
            foreach ($tenVC as  $ten) {
                $nameVC = $ten->tenVaccine;
            }
            foreach ($dottiem as $dt) {
                $bt = $dt->ngayBD;
                $kt = $dt->ngayKT;
                $dd = $dt->tenDiaDiem;
            }
            $message = $request->nametre." có mã là ".$id_kid." có lịch tiêm vaccine ".$nameVC." từ ngày ".$bt." đến ngày ".$kt." tại ".$dd." và mã đăng ký của bạn là ".$iddkt;
            //open connection

            $ch = curl_init();

            //set the url, number of POST vars, POST data
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_USERPWD, getenv("TWILIO_SID").':'.getenv("TWILIO_TOKEN"));
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
            curl_setopt($ch, CURLOPT_URL, sprintf('https://api.twilio.com/2010-04-01/Accounts/'.getenv("TWILIO_SID").'/Messages.json', getenv("TWILIO_SID")));
            curl_setopt($ch, CURLOPT_POST, 3);
            curl_setopt($ch, CURLOPT_POSTFIELDS, 'To='.$to.'&From='.$from.'&Body='.$message);

            // execute post
            $result = curl_exec($ch);
            $result = json_decode($result);

            // close connection
            curl_close($ch);
            Session::flash('status','Đăng ký Thành Công! Hệ thống sẽ gửi tin nhắn về cho bạn!');
            return Redirect::to('/');
        }
        else{    
            Session::flash('status','Đăng Ký Không Thành Công');
            return Redirect::to('/dangkytiemchung'); 
        }
    }

    public function timkiemmatre(Request $request)
    {   
        $ngh = DB::table('guardians')->get();
        if ($request->all() != null) {
            $kids = DB::table('kids')->where('name','like', '%'.$request->tentre.'%')->orwhere('ngaySinh',$request->ns)->get();
        }
        else
        {
            $kids = [];
        }
        
        return view('Page.timkiemmatre')->with('kids',$kids)->with('ngh',$ngh);
    }


    public function dadangky($id)
    {
        $getday = date('Y-m-d');
        $dkts = DB::table('dangkytiem')->where('TinhTrang','=','Đợi Duyệt')->paginate(6);
        $vaccines = DB::table('vaccines')->get();
        $dottiems = DB::table('dottiem')->get();
        $nghs = DB::table('guardians')->get();
        $kids = DB::table('kids')->get();
        $lsts =  DB::select("SELECT dangkytiem.* FROM dangkytiem JOIN kids ON dangkytiem.kid_id = kids.id JOIN guardians ON kids.nguoigiamho_id = guardians.id JOIN users ON guardians.user_id = users.id  WHERE users.id = $id AND dangkytiem.TinhTrang = 'Đợi Duyệt'");
        return view('Page.dadangky')->with('lsts',$lsts)->with('dkts',$dkts)->with('dottiems',$dottiems)->with('vaccines',$vaccines)->with('nghs',$nghs)->with('kids',$kids);;
        return view('Page.dadangky');
    }
    public function xulytiem(Request $request)
    {
        $madk = $request->madk;
        $getday = date('Y-m-d');
        $dkts = DB::select("SELECT dangkytiem.* FROM dangkytiem  WHERE dangkytiem.id = $madk AND dangkytiem.TinhTrang = 'Đợi Duyệt'");
        
        if ($dkts == null) {
            Session::put('message-xlt','Không tìm thấy mã đăng ký!');
            return Redirect::to('/timkiemtredkt');
        }
        else
        {
            foreach ($dkts as $value) {
                $kid_id = $value->kid_id;
            }
            $vaccines = DB::table('vaccines')->get();
            $dottiems = DB::table('dottiem')->get();
            $nghs = DB::table('guardians')->get();
            $kids = DB::table('kids')->get();
            $tre = DB::select("SELECT kids.*  FROM kids WHERE id = $kid_id");
            $smvc = DB::select("SELECT vaccines.id,vaccines.tenVaccine,vaccines.soLuong, count(lieutrinh.id) as smt FROM lieutrinh JOIN vaccines ON lieutrinh.vaccine_id=vaccines.id GROUP BY
                                    vaccines.id, lieutrinh.vaccine_id,vaccines.tenVaccine,vaccines.soLuong
                                order by 1");
                    // dd($smvc);
            $lsts =  DB::select("SELECT dangkytiem.* FROM dangkytiem JOIN kids ON dangkytiem.kid_id = kids.id JOIN guardians ON kids.nguoigiamho_id = guardians.id JOIN users ON guardians.user_id = users.id  WHERE kids.id = $kid_id AND dangkytiem.TinhTrang = 'Đã Tiêm'");

            $tongsomui =  DB::select("SELECT  dangkytiem.vaccine_id,dangkytiem.kid_id,dangkytiem.TinhTrang, count(dangkytiem.id) as smdt FROM dangkytiem JOIN kids ON dangkytiem.kid_id = kids.id JOIN guardians ON kids.nguoigiamho_id = guardians.id JOIN users ON guardians.user_id = users.id  WHERE kids.id = $kid_id AND dangkytiem.TinhTrang = 'Đã Tiêm' GROUP BY dangkytiem.vaccine_id,dangkytiem.kid_id,dangkytiem.TinhTrang");
            return view('Page.xulytiem')->with('dkts',$dkts)->with('dottiems',$dottiems)->with('vaccines',$vaccines)->with('nghs',$nghs)->with('kids',$kids)->with('smvc',$smvc)->with('lsts',$lsts)->with('tongsomui',$tongsomui)->with('tre',$tre);
        }
    }
    public function xulytiem_post(Request $request,$id,$user_id)
    {
        $getday = date('Y-m-d');
        $data = array();
        $data['TinhTrang'] = 'Đã Duyệt Tiêm';
        $data['NgayTiem'] = $getday;
        $data['bacsi_id'] = $user_id;
        $data['BacSiTuVan'] = $request->tuvan;
        if($data){
            DB::table('dangkytiem')->where('id',$id)->update($data);
            Session::put('message-xulytiem','Đã duyệt tiêm cho trẻ thành công');
            return Redirect::to('/timkiemtredkt');
        }
        else
        {
            Session::put('message-xulytiem','Xử lý thất bại!');
            return Redirect::to('/timkiemtredkt');
        }
    }
    public function xulytiem_cancel(Request $request,$id,$user_id)
    {
        $getday = date('Y-m-d');
        $data = array();
        $data['TinhTrang'] = 'Đã Hủy';
        $data['bacsi_id'] = $user_id;
        $data['BacSiTuVan'] = $request->tuvan;

        if($data){
            DB::table('dangkytiem')->where('id',$id)->update($data);
            Session::put('message-xulytiem','Từ chối tiêm chủng cho trẻ thành công');
            return Redirect::to('/timkiemtredkt');
        }
        else
        {
            Session::put('message-xulytiem','Xử lý thất bại!');
            return Redirect::to('/timkiemtredkt');
        }
    }
    public function xulytt(Request $request)
    {
        $madk = $request->madk;
        $getday = date('Y-m-d');
        $dkts = DB::select("SELECT dangkytiem.* FROM dangkytiem  WHERE dangkytiem.id = $madk AND dangkytiem.TinhTrang = 'Đã Duyệt Tiêm'");
        $vaccines = DB::table('vaccines')->get();
        $dottiems = DB::table('dottiem')->get();
        $nghs = DB::table('guardians')->get();
        $kids = DB::table('kids')->get();
        if ($dkts == null) {
            Session::put('message-xulytt','Không tìm thấy mã đăng ký!');
            return Redirect::to('/timkiemtreyta');
        }
        else
        {
            return view('Page.xulythongtin')->with('dkts',$dkts)->with('dottiems',$dottiems)->with('vaccines',$vaccines)->with('nghs',$nghs)->with('kids',$kids);
        }
    }
    public function xulytt_post($id,$user_id)
    {
        $getday = date('Y-m-d');
        $data = array();
        $data['TinhTrang'] = 'Đã Tiêm';
        $data['yta_id'] = $user_id;
        $vaccine = DB::select("SELECT vaccines.* FROM vaccines JOIN dangkytiem ON dangkytiem.vaccine_id = vaccines.id WHERE dangkytiem.id = $id");
        
        if($data){
            foreach ($vaccine as  $vc) {
                $sl = $vc->soLuong-1;
                DB::table('vaccines')->where('id',$vc->id)->update([
                'soLuong' => $sl,
                ]);
            }
            DB::table('dangkytiem')->where('id',$id)->update($data);
            Session::put('message-xulytt','Thay đổi tình trạng đã tiêm cho trẻ thành công');
            return Redirect::to('/timkiemtreyta');
        }
        else
        {
            Session::put('message-xulytt','Thay đổi tình trạng đã tiêm cho trẻ không thành công');
            return Redirect::to('/timkiemtreyta');
        }

    }
    public function lichsutiem($id)
    {
        $getday = date('Y-m-d');
        // $vaccines = DB::table('vaccines')->get();
        $vaccines = DB::select("SELECT vaccines.id,vaccines.tenVaccine,vaccines.soLuong, count(lieutrinh.id) as smt FROM lieutrinh JOIN vaccines ON lieutrinh.vaccine_id=vaccines.id GROUP BY
                                vaccines.id, lieutrinh.vaccine_id,vaccines.tenVaccine,vaccines.soLuong
                            order by 1");
        $dottiems = DB::table('dottiem')->get();
        $nghs = DB::table('guardians')->get();
        $kids = DB::table('kids')->get();
        $lsts =  DB::select("SELECT dangkytiem.* FROM dangkytiem JOIN kids ON dangkytiem.kid_id = kids.id JOIN guardians ON kids.nguoigiamho_id = guardians.id JOIN users ON guardians.user_id = users.id  WHERE users.id = $id AND dangkytiem.TinhTrang = 'Đã Tiêm'");
        // dd(DB::table('kids')->get());
        // dd($id);
        $tongsomui =  DB::select("SELECT  dangkytiem.vaccine_id,dangkytiem.kid_id,dangkytiem.TinhTrang, count(dangkytiem.id) as smdt FROM dangkytiem JOIN kids ON dangkytiem.kid_id = kids.id JOIN guardians ON kids.nguoigiamho_id = guardians.id JOIN users ON guardians.user_id = users.id  WHERE users.id = $id AND dangkytiem.TinhTrang = 'Đã Tiêm' GROUP BY dangkytiem.vaccine_id,dangkytiem.kid_id,dangkytiem.TinhTrang");
        // dd($tongsomui);
        return view('Page.lichsu')->with('lsts',$lsts)->with('dottiems',$dottiems)->with('vaccines',$vaccines)->with('nghs',$nghs)->with('kids',$kids)->with('tongsomui',$tongsomui);
    }

    public function chitietls($kid_id,$vaccine_id)
    {
        $vaccines = DB::select("SELECT vaccines.id,vaccines.tenVaccine,vaccines.soLuong, count(lieutrinh.id) as smt FROM lieutrinh JOIN vaccines ON lieutrinh.vaccine_id=vaccines.id GROUP BY
                                vaccines.id, lieutrinh.vaccine_id,vaccines.tenVaccine,vaccines.soLuong
                            order by 1");
        $dottiems = DB::table('dottiem')->get();
        $nghs = DB::table('guardians')->get();
        $kids = DB::table('kids')->get();
        $lsts =  DB::select("SELECT dangkytiem.* FROM dangkytiem JOIN kids ON dangkytiem.kid_id = kids.id JOIN guardians ON kids.nguoigiamho_id = guardians.id JOIN users ON guardians.user_id = users.id  WHERE dangkytiem.TinhTrang = 'Đã Tiêm' AND dangkytiem.kid_id = $kid_id AND dangkytiem.vaccine_id = $vaccine_id");
        return view('Page.chitietlichsu')->with('lsts',$lsts)->with('dottiems',$dottiems)->with('vaccines',$vaccines)->with('nghs',$nghs)->with('kids',$kids);
    }

    public function timkiemtredkt()
    {
        return view('Page.timkiemtredkt');
    }

    public function timkiemtreyta()
    {
        return view('Page.timkiemtreyta');
    }

    public function dangkytiemchungcoma(Request $request)
    {
        $getday = date('Y-m-d');
        $vaccines = DB::table('vaccines')->get();
        $dottiem = DB::table('dottiem')->where('ngayBD','>',$getday)->get();
        $px = DB::table('phuongxa')->get();
        $qh = DB::table('quanhuyen')->get();
        if ($request->matre != null) {
            $kid_id = $request->matre;
            $getday = date('Y-m-d');
            $tre = DB::select("SELECT kids.*  FROM kids WHERE id = $request->matre");
            if ($tre != []) {

                foreach ($tre as $t) {
                    $ngh_id = $t->nguoigiamho_id;
                }
                $ngh = DB::select("SELECT guardians.*  FROM guardians WHERE id = $ngh_id");

                $smvc = DB::select("SELECT vaccines.id,vaccines.tenVaccine,vaccines.soLuong, count(lieutrinh.id) as smt FROM lieutrinh JOIN vaccines ON lieutrinh.vaccine_id=vaccines.id GROUP BY
                                vaccines.id, lieutrinh.vaccine_id,vaccines.tenVaccine,vaccines.soLuong
                            order by 1");
                // dd($smvc);
                $lsts =  DB::select("SELECT dangkytiem.* FROM dangkytiem JOIN kids ON dangkytiem.kid_id = kids.id JOIN guardians ON kids.nguoigiamho_id = guardians.id JOIN users ON guardians.user_id = users.id  WHERE kids.id = $request->matre AND dangkytiem.TinhTrang = 'Đã Tiêm'");

                $tongsomui =  DB::select("SELECT  dangkytiem.vaccine_id,dangkytiem.kid_id,dangkytiem.TinhTrang, count(dangkytiem.id) as smdt FROM dangkytiem JOIN kids ON dangkytiem.kid_id = kids.id JOIN guardians ON kids.nguoigiamho_id = guardians.id JOIN users ON guardians.user_id = users.id  WHERE kids.id = $request->matre AND dangkytiem.TinhTrang = 'Đã Tiêm' GROUP BY dangkytiem.vaccine_id,dangkytiem.kid_id,dangkytiem.TinhTrang");

                return view('Page.dangkytiemcomatre')->with('tre',$tre)->with('ngh',$ngh)->with('vaccines',$vaccines)->with('dottiem',$dottiem)->with('dottiem',$dottiem)->with('px',$px)->with('smvc',$smvc)->with('lsts',$lsts)->with('tongsomui',$tongsomui)->with('kid_id',$kid_id)->with('ngh_id',$ngh_id);   
            }
            else
            {
                Session::put('message-dktc','Không tìm thấy mã trẻ! Xin hãy nhập lại!');
                return Redirect::to('/dangkytiemchung');
            }
            
        }
        else{
            Session::put('message-dktc','Không tìm thấy mã trẻ! Xin hãy nhập lại!');
            return Redirect::to('/dangkytiemchung');
        }
        
    }
}
