@extends('layout')
@section('content')
<div class="pt-2" style="height: 60px;background: #f8f8f8;line-height: 60px; padding-left: 20px;">
    <a href="{{route('dangkytiemchung')}}" style="float: left; margin-right: 10px"><h2><i class="fa fa-arrow-left"></i></h2></a>
   <h2 style="font-weight: 400;">Tìm Kiếm Mã Trẻ Đã Đăng Ký Tiêm Chủng</h2>
</div>
<div>
    <form action="{{ route('timkiemmatre')}}" method="get">
        {{ csrf_field() }}
        <div class="controls">
            <p class="mt-2"><b>Tìm kiếm thông tin của trẻ</b></p>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tentre">Tên Trẻ</label>
                        <input type="text" class="form-control" id="tentre" name="tentre" placeholder="Nhập tên trẻ">
                      </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ns">Ngày Sinh</label>
                        <input type="date" class="form-control" id="ns" name="ns" placeholder="Nhập Ngày Sinh của trẻ">
                    </div>
                </div>
            </div>  
        </div>
        <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Tìm Kiếm</button>
    </form>
    @if($kids != [])
    <table class="table">
      <thead>
        <tr>
            <th style="text-align: center;">Mã Trẻ</th>
            <th style="text-align: center;">Tên Trẻ</th>
            <th style="text-align: center;">Ngày Sinh</th>
            <th style="text-align: center;">Giới Tính</th>
            <th style="text-align: center;">Tên Người Giám Hộ</th>
        </tr>
      </thead>
      <tbody>
        @foreach($kids as $kid)
            <tr>
                <td style="text-align: center;">{{ $kid->id }}</td>
                <td style="text-align: center;">{{ $kid->name }}</td>
                <td style="text-align: center;">{{ $kid->ngaySinh }}</td>
                <td style="text-align: center;">{{ $kid->gioiTinh }}</td>
                
                @foreach($ngh as $n)
                  @if($kid->nguoigiamho_id == $n->id)
                    <td style="text-align: center;">{{ $n->tenNGH }}</td>
                  @endif
                @endforeach          
            </tr>
        @endforeach
      </tbody>
    </table>
    @endif
</div>
@endsection