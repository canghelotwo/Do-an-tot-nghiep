@extends('layout')
@section('content')
<div class="pt-2" style="height: 60px;background: #f8f8f8;line-height: 60px; padding-left: 20px;">
   
   <h2 style="font-weight: 400;">Lịch Đăng ký tiêm</h2>
</div>
<table class="table">
  <thead>
    <tr>
        <th style="text-align: center;">STT</th>
        <th style="text-align: center;">Tên Trẻ</th>
        <th style="text-align: center;">Tên Vaccine</th>
        <th style="text-align: center;">Đợt Tiêm</th>
        <th style="text-align: center;">Ngày Đăng Ký</th>
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

        @foreach($dottiems as $dottiem)
          @if($lst->dottiem_id == $dottiem->id)
            <td style="text-align: center;">{{ $dottiem->tenDiaDiem }}({{$dottiem->ngayBD}} - {{$dottiem->ngayKT}})</td>
          @endif
        @endforeach
        
        <td style="text-align: center;">{{ $lst->NgayDK }}</td>
        <td style="text-align: center;">{{ $lst->MuiThu }}</td>
      </tr>
      @endforeach
  </tbody>
</table>
@endsection