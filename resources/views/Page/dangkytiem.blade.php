@extends('layout')
@section('content')
<div class="pt-2" style="height: 60px;background: #f8f8f8;line-height: 60px; padding-left: 20px;">
   <h2 style="font-weight: 400;">Đăng Ký Tiêm Chủng</h2>
</div>
<div>
    <?php
        $message = Session::get('message-dktc');
        if($message){
            echo '<div class="alert alert-success mt-2"><span>'.$message.'</span></div>';
            Session::put('message-dktc',null);
        }
    ?>
    <form action="{{ route('dangkytiemchungcoma')}}" method="post">
        {{ csrf_field() }}
        <div class="controls">
            <p class="mt-2"><b>Nếu đã đăng ký có thể tìm kiếm thông tin của trẻ tại đây:</b></p>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="matre">Mã Trẻ</label>
                        <input type="text" class="form-control" id="matre" name="matre" placeholder="Nhập mã trẻ" required>
                      </div>
                </div>
            </div>  
        </div>
        <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Tìm Kiếm</button>
        <br>
        <label>Nếu khống nhớ mã trẻ có thể <a href="{{route('timkiemmatre')}}">tìm kiếm ở đây</a></label>
    </form>
</div>

<div>
    @if(\Auth::check())
        <form action="{{ route('dktc_post_user',Auth::user()->id)}}" method="post">
    @else
        <form action="{{ route('dktc_post')}}" method="post">
    @endif
        {{ csrf_field() }}
        <div class="controls">
            <p class="mt-2"><b>1.Thông tin người giám hộ</b></p>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="name">Tên Người giám hộ (*)</label>
                        @if(\Auth::check())
                        <input id="name" type="text" name="name" class="form-control" placeholder="Nhập tên người dám hộ" required="required" value="{{Auth::user()->name}}">
                        @else
                            <input id="name" type="text" name="name" class="form-control" placeholder="Nhập tên người dám hộ" required="required">
                        @endif
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="sdt">Số điện thoại (*)</label>
                        @if(\Auth::check())
                        <input id="sdt" type="text" name="sdt" class="form-control" placeholder="Nhập số điện thoại" required="required" value="{{Auth::user()->SDT}}">
                        @else
                            <input id="sdt" type="text" name="sdt" class="form-control" placeholder="Nhập số điện thoại" required="required">
                        @endif
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="cmnd">CMND/CCCD (*)</label>
                        <input id="cmnd" type="text" name="cmnd" class="form-control" placeholder="Nhập số CMND/CCCD" required="required">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="mqh">Mối quan hệ (*)</label>
                        <input id="mqh" type="text" name="mqh" class="form-control" placeholder="Nhập mối quan hệ" required="required">
                    </div>
                </div>
            </div>
            <p class="mt-2"><b>2.Thông tin trẻ đăng ký tiêm chủng</b></p>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="nametre">Tên trẻ em (*)</label>
                        <input id="nametre" type="text" name="nametre" class="form-control" placeholder="Nhập tên trẻ em" required="required">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="ns">Ngày sinh (*)</label>
                        <input id="ns" type="date" name="ns" class="form-control" placeholder="Nhập ngày sinh" required="required">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="gttre">Giới tính (*)</label>
                        <select id="gttre" name="gttre" class="form-control" required="required">
                            <option value="Nam">Nam</option>
                            <option value="Nữ">Nữ</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="bhyt">Số thẻ BHYT</label>
                        <input id="bhyt" type="text" name="bhyt" class="form-control" placeholder="Nhập số thẻ BHYT">
                    </div>
                </div>
            </div>
            <p class="mt-2"><b>3.Thông tin đợt tiêm</b></p>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="dottiem">Đợt Tiêm (*)</label>
                        <select id="dottiem" name="dottiem" class="form-control" required="required">
                            @foreach($dottiem as  $dt)
                                <option selected value="{{$dt->id}}">{{$dt->tenDiaDiem}} (từ ngày: {{$dt->ngayBD }} - đến ngày {{$dt->ngayKT}})</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <p class="mt-2"><b>4.Thông tin vaccine</b></p>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="vaccine">Tên Vaccine (*)</label>
                        <select id="vaccine" name="vaccine" class="form-control" required="required">
                            @foreach($vaccine as  $vc)
                                    <option selected value="{{$vc->id}}">{{$vc->tenVaccine}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="muitt">Mũi tiêm thứ (*)</label>
                        <select id="muitt" name="muitt" class="form-control" required="required">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                </div>
            </div>  
            <div class="col-md-12 mt-3">
              <input type="submit" class="btn btn-success btn-send" value="Đăng ký tiêm chủng">
            </div>
            <!-- <label style="margin-top: 10px;">(*)Nếu trẻ đã tiêm chủng thì chọn <a href="{{route('timkiemmatre')}}">đăng ký ở đây</a></label> -->
        </div>
    </form>
</div>
@endsection