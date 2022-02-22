@extends('layout')
@section('content')
<div class="pt-2" style="height: 60px;background: #f8f8f8;line-height: 60px; padding-left: 20px;">
    <a href="javascript:history.back()" style="float: left; margin-right: 10px"><h2><i class="fa fa-arrow-left"></i></h2></a>
   <h2 style="font-weight: 400;">Đăng Ký Tiêm Chủng</h2>
</div>
<div>
    <form action="{{route('dktc_coma', $kid_id)}}" method="post">
        {{ csrf_field() }}
        <div class="controls">
            <p class="mt-2"><b>1.Thông tin người giám hộ</b></p>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="name">Tên Người giám hộ (*)</label>
                        @foreach($ngh as  $n)
                            <input id="name" type="text" name="name" class="form-control" value="{{$n->tenNGH}}" required="required" disabled="true">
                        @endforeach
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="sdt">Số điện thoại (*)</label>
                        @foreach($ngh as  $n)
                            <input id="sdt" type="text" name="sdt" class="form-control" value="{{$n->SDT}}" required="required" disabled="true">
                        @endforeach
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="cmnd">CMND/CCCD (*)</label>
                        @foreach($ngh as  $n)
                            <input id="cmnd" type="text" name="cmnd" class="form-control" value="{{$n->CMND}}" required="required" disabled="true">
                        @endforeach
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="mqh">Mối quan hệ (*)</label>
                        @foreach($ngh as  $n)
                            <input id="mqh" type="text" name="mqh" class="form-control" value="{{$n->moiQH}}" required="required" disabled="true">
                        @endforeach
                    </div>
                </div>
            </div>
            <p class="mt-2"><b>2.Thông tin trẻ đăng ký tiêm chủng</b></p>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="nametre">Tên trẻ em (*)</label>
                        @foreach($tre as  $t)
                            <input id="nametre" type="text" name="nametre" class="form-control" value="{{$t->name}}" required="required" disabled="true">
                        @endforeach
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="ns">Ngày sinh (*)</label>
                        @foreach($tre as  $t)
                            <input id="ns" type="date" name="ns" class="form-control" value="{{$t->ngaySinh}}" required="required" disabled="true">
                        @endforeach
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="gttre">Giới tính (*)</label>
                        @foreach($tre as  $t)
                            <input id="gttre" type="text" name="gttre" class="form-control" value="{{$t->gioiTinh}}" required="required" disabled="true">
                        @endforeach
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="bhyt">Số thẻ BHYT</label>
                        @foreach($tre as  $t)
                            <input id="bhyt" type="text" name="bhyt" class="form-control" value="{{$t->soTheBH}}" disabled="true">
                        @endforeach
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
                            @foreach($vaccines as  $vc)
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
        </div>
    </form>
    <h5 class="mt-2"><b>Lịch sử tiêm chủng của trẻ</b></h5>
    <table class="table">
      <thead>
        <tr>
            <th style="text-align: center;">STT</th>
            <th style="text-align: center;">Tên Trẻ</th>
            <th style="text-align: center;">Tên Vaccine</th>
            <th style="text-align: center;">Tổng Số Mũi Cần Tiêm</th>
            <th style="text-align: center;">Tổng Số Mũi Đã Tiêm</th>
        </tr>
      </thead>
      <tbody>
        @foreach($tongsomui as $key=>$tsm)
          <tr>
            <td style="text-align: center;">{{ $key+1 }}</td>

            @foreach($tre as $t)
                <td style="text-align: center;">{{ $t->name }}</td>
            @endforeach

            @foreach($vaccines as $vaccine)
              @if($tsm->vaccine_id == $vaccine->id)
                <td style="text-align: center;">{{ $vaccine->tenVaccine }}</td>
              @endif
            @endforeach

            @foreach($smvc as $sm)
              @if($tsm->vaccine_id == $sm->id)
                <td style="text-align: center;">{{ $sm->smt }}</td>
              @endif
            @endforeach
            <td style="text-align: center;">{{ $tsm->smdt }}</td>
          </tr>
          @endforeach
      </tbody>
    </table>
</div>
@endsection