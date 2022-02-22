@extends('layout')
@section('content')
<div class="pt-2" style="height: 60px;background: #f8f8f8;line-height: 60px; padding-left: 20px;">
  <a href="javascript:history.back()" style="float: left; margin-right: 10px"><h2><i class="fa fa-arrow-left"></i></h2></a>
   <h2 style="font-weight: 400;">Chi Tiết Lịch Sử Tiêm</h2>
</div>

<table class="table">
  <thead>
    <tr>
        <th style="text-align: center;">STT</th>
        <th style="text-align: center;">Tên Trẻ</th>
        <th style="text-align: center;">Tên Vaccine</th>
        <th style="text-align: center;">Đợt Tiêm</th>
        <th style="text-align: center;">Ngày Tiêm</th>
        <th style="text-align: center;">Mũi Thứ</th>
    </tr>
  </thead>
  <tbody>
    @foreach($lsts as $key=>$lst)
      <tr>
        <td style="text-align: center;">{{ $key+1 }}</td>

        @foreach($kids as $kid)
          @if($lst->kid_id == $kid->id)
            <td style="text-align: center;">{{ $kid->name }}</td>
          @endif
        @endforeach

        @foreach($vaccines as $vaccine)
          @if($lst->vaccine_id == $vaccine->id)
            <td style="text-align: center;">{{ $vaccine->tenVaccine }}</td>
          @endif
        @endforeach

        @foreach($dottiems as $dt)
          @if($lst->dottiem_id == $dt->id)
            <td style="text-align: center;">{{ $dt->tenDiaDiem }} ({{$dt->ngayBD}} - {{$dt->ngayKT}})</td>
          @endif
        @endforeach
        <td style="text-align: center;">{{ $lst->NgayTiem }}</td>
        <td style="text-align: center;">{{ $lst->MuiThu }}</td>
      </tr>
      @endforeach
  </tbody>
</table>
@endsection