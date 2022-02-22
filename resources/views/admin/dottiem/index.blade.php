@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <button type="button" class="btn btn-success" style="margin-bottom: 10px;width: 200px;height: 40px;font-size: 18px"><a href="{{URL::to('/admin/dottiem/add')}}" style="color: white">Tạo mới đợt tiêm</a></button>
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh Sách Đợt Tiêm
    </div>
    <div class="table-responsive">
      <?php
            $message = Session::get('message');
            if($message){
                echo '<span class="text-alert">'.$message.'</span>';
                Session::put('message',null);
            }
      ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>STT</th>
            <th>Tên Địa Điểm</th>
            <th>Ngày Bắt Đầu</th>
            <th>Ngày Kết Thúc</th>
            <th>Phường/Xã</th>
            <th>Chức Năng</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_dottiem as $key => $dottiem)
          <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $dottiem->tenDiaDiem }}</td>
            <td>{{ $dottiem->ngayBD }}</td>
            <td>{{ $dottiem->ngayKT }}</td>
            @foreach($phuongxa as $px)
              @if($px->id == $dottiem->phuongxa_id)
                <td>{{ $px->name }}</td>
              @endif
            @endforeach
            <td>
              <a href="{{ route('dottiem.edit',$dottiem->id)}}" class="active styling-edit" ui-toggle-class="" style="margin: 0px 15px;">
                <i class="fa fa-pencil-square-o text-success text-active"></i>
              </a>
              <a onclick="return confirm('Bạn có chắc là muốn xóa không?')" href="{{ route('dottiem.delete',$dottiem->id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-trash-o text-danger text"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div style="text-align: center;">{{ $all_dottiem->links() }}</div>
    </div>
  </div>
</div>
@endsection