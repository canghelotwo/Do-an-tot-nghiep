@extends('layout')
@section('content')
<div class="pt-2" style="height: 60px;background: #f8f8f8;line-height: 60px; padding-left: 20px;">
  <a href="{{route('bacsitimkiem')}}" style="float: left; margin-right: 10px"><h2><i class="fa fa-arrow-left"></i></h2></a>
   <h2 style="font-weight: 400;">THÔNG TIN TRẺ ĐĂNG KÝ TIÊM</h2>
</div>
<!-- @if (session('message-xulytiem'))
    <div class="alert alert-success mt-2">
      {{ session('message-xulytiem') }}
    </div>
@endif -->
<p style="font-size: 20px" class="mt-3">1.Thông tin trẻ đăng ký tiêm chủng</p>
<table class="table">
  <thead>
    <tr>
      <th style="text-align: center;">Mã Trẻ</th>
      <th style="text-align: center;">Tên Trẻ</th>
      <th style="text-align: center;">Tên Vaccine</th>
      <th style="text-align: center;">Đợt Tiêm</th>
      <th style="text-align: center;">Ngày Đăng Ký</th>
      <th style="text-align: center;">Mũi Thứ</th>
        <!-- <th style="text-align: center;">Duyệt</th> -->
    </tr>
  </thead>
  <tbody>
    @foreach($dkts as $key=>$dkt)
      <tr>

        @foreach($kids as $kid)
          @if($dkt->kid_id == $kid->id)
            <td style="text-align: center;">{{ $kid->id }}</td>
          @endif
        @endforeach

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
        <!-- <td style="text-align: center;">
          <a onclick="return confirm('Bạn xác nhận tiêm cho trẻ này không?')" href="{{ route('xulytiem_post',['id' => $dkt->id, 'user_id' => Auth::user()->id]) }}" class="active styling-edit" style="margin-right: 5px;">
            <i class="fa fa-check text-success text"></i>
          </a>
          <a onclick="return confirm('Bạn xác nhận không tiêm cho trẻ này không?')" href="{{ route('xulytiem_cancel',['id' => $dkt->id, 'user_id' => Auth::user()->id])}}" class="active styling-edit" ui-toggle-class="">
            <i class="fa fa-times text-danger text"></i>
          </a>
        </td> -->
        <!-- <td><a href="{{route('chitietls',['kid_id' => $dkt->kid_id, 'vaccine_id' => $dkt->vaccine_id])}}">Xem lịch sử</a></td> -->
      </tr>
      @endforeach
  </tbody>
</table>
<form action="{{route('xulytiem_post', ['id' => $dkt->id, 'user_id' => Auth::user()->id])}}" method="post"> 
  {{ csrf_field() }}
  <p style="font-size: 20px" class="mt-3 mb-2">2.Lời khuyên của bác sĩ</p>
  <div class="form-group">
      <label for="tuvan">Bác Sĩ Tư Vấn:</label>
      <textarea class="form-control" id="tuvan" name="tuvan" rows="3"></textarea>
  </div>
  <div class="mt-2" style="float: right;">
    <button type="submit" class="btn btn-primary">Duyệt</button>
    <a onclick="return confirm('Bạn xác nhận không tiêm cho trẻ này không?')" href="{{ route('xulytiem_cancel',['id' => $dkt->id, 'user_id' => Auth::user()->id])}}" class="btn btn-danger">Từ Chối</a>
  </div>
</form>
<p style="font-size: 20px;clear: both;" class="mt-3 mb-2">3.Lịch sử tiêm chủng của trẻ</p>
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
@endsection