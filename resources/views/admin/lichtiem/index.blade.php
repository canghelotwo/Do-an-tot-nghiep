@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh Sách Lịch Tiêm
    </div>
    <div class="text-success h4">
        <?php
            $message = Session::get('message');
            if($message){
                echo '<span class="text-alert">'.$message.'</span>';
                Session::put('message',null);
            }
        ?>
    </div>
  <form action="{{ route('lichtiem')}}" method="get" class="form-inline" style="padding-left: 20px;float: left;">
      {{ csrf_field() }}
      <div class="form-group">
        <label for="dottiem">Đợt Tiêm:</label>
        <select id="dottiem" name="dottiem" style="width: 600px" class="form-control mx-sm-3">
            <option selected>--Chọn địa điểm tiêm--</option>
            @foreach($dottiems as  $dt)
                <option value="{{$dt->id}}">{{$dt->tenDiaDiem}} (từ ngày: {{$dt->ngayBD }} - đến ngày {{$dt->ngayKT}})</option>
            @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="tt">Tình Trạng:</label>
        <select id="tt" name="tt" style="width: 200px" class="form-control mx-sm-3">
            <option selected value="Đợi Duyệt">Đợi Duyệt</option>
            <option  value="Đã Duyệt Tiêm">Đã Duyệt Tiêm</option>
            <option  value="Đã Hủy">Đã Hủy</option>
            <option  value="Đã Tiêm">Đã Tiêm</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Thống Kê</button>
  </form>
  @if($dt_id !=null)
  <a href="{{ route('export',$dt_id)}}" style="float: right;" class="btn btn-primary">Xuất</a>
  @endif
    <table class="table">
      <thead>
        <tr>
            <th style="text-align: center;">STT</th>
            <th style="text-align: center;">Tên Trẻ</th>
            <th style="text-align: center;">Tên Vaccine</th>
            <th style="text-align: center;">Đợt Tiêm</th>
            <th style="text-align: center;">Ngày Đăng Ký</th>
            <th style="text-align: center;">Mũi Thứ</th>
            <th style="text-align: center;">Tình Trạng</th>
        </tr>
      </thead>
      <tbody>
        @foreach($dkts as $key=>$dkt)
          <tr>
            <td style="text-align: center;">{{ $key+1 }}</td>
            @foreach($kids as $kid)
              @if($dkt->kid_id == $kid->id)
                <td style="text-align: center;">{{ $kid->name }}</td>
              @endif
            @endforeach
            @foreach($vaccines as $vaccine)
              @if($dkt->vaccine_id == $vaccine->id)
                <td style="text-align: center;">{{ $vaccine->tenVaccine }}</td>
              @endif
            @endforeach
            @foreach($dottiems as $dottiem)
              @if($dkt->dottiem_id == $dottiem->id)
                <td style="text-align: center;">{{ $dottiem->tenDiaDiem }}({{$dottiem->ngayBD}} - {{$dottiem->ngayKT}})</td>
              @endif
            @endforeach
            <td style="text-align: center;">{{ $dkt->NgayDK }}</td>
            <td style="text-align: center;">{{ $dkt->MuiThu }}</td>
            <td style="text-align: center;">{{ $dkt->TinhTrang }}</td>
          </tr>
          @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection