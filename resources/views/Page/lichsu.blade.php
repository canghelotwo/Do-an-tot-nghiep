@extends('layout')
@section('content')
<div class="pt-2" style="height: 60px;background: #f8f8f8;line-height: 60px; padding-left: 20px;">
   <h2 style="font-weight: 400;">Lịch Sử Tiêm Chủng</h2>
</div>
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

        @foreach($kids as $kid)
          @if($tsm->kid_id == $kid->id)
            <td style="text-align: center;">{{ $kid->name }}</td>
          @endif
        @endforeach

        @foreach($vaccines as $vaccine)
          @if($tsm->vaccine_id == $vaccine->id)
            <td style="text-align: center;">{{ $vaccine->tenVaccine }}</td>
          @endif
        @endforeach

        @foreach($vaccines as $vaccine)
          @if($tsm->vaccine_id == $vaccine->id)
            <td style="text-align: center;">{{ $vaccine->smt }}</td>
          @endif
        @endforeach
        <td style="text-align: center;">{{ $tsm->smdt }}</td>
        <td><a href="{{route('chitietls',['kid_id' => $tsm->kid_id, 'vaccine_id' => $tsm->vaccine_id])}}">Chi Tiết</a></td>
      </tr>
      @endforeach
  </tbody>
</table>
@endsection