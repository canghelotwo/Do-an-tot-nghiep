@extends('layout')
@section('content')
<div class="pt-2" style="height: 60px;background: #f8f8f8;line-height: 60px; padding-left: 20px;">
  <a href="{{route('ytatimkiem')}}" style="float: left; margin-right: 10px"><h2><i class="fa fa-arrow-left"></i></h2></a>
   <h2 style="font-weight: 400;">THÔNG TIN TRẺ ĐÃ ĐƯỢC DUYỆT TIÊM</h2>
</div>
@if (session('message-xulytt'))
    <div class="alert alert-success mt-2">
      {{ session('message-xulytt') }}
    </div>
@endif
<table class="table">
  <thead>
    <tr>
        <th style="text-align: center;">STT</th>
        <th style="text-align: center;">Tên Trẻ</th>
        <th style="text-align: center;">Tên Vaccine</th>
        <th style="text-align: center;">Đợt Tiêm</th>
        <th style="text-align: center;">Ngày Tiêm</th>
        <th style="text-align: center;">Mũi Thứ</th>
        <th style="text-align: center;">BSTV</th>
        <th style="text-align: center;">Xác Nhận</th>
        <th style="width:30px;"></th>
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
        
        <td style="text-align: center;">{{ $dkt->NgayTiem }}</td>
        <td style="text-align: center;">{{ $dkt->MuiThu }}</td>
        <td style="text-align: center;">{{ $dkt->BacSiTuVan}}</td>
        <td style="text-align: center;">
          <a onclick="return confirm('Bạn xác nhận đã tiêm cho trẻ này?')" href="{{ route('xulytt_post',['id' => $dkt->id, 'user_id' => Auth::user()->id])}}" class="active styling-edit " ui-toggle-class="">
            <i class="fa fa-check text-success text"></i>
          </a>
        </td>
      </tr>
      @endforeach
  </tbody>
</table>
@endsection