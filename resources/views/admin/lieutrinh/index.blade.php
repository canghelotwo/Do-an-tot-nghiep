@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <button type="button" class="btn btn-success" style="margin-bottom: 10px;width: 200px;height: 40px;font-size: 18px"><a href="{{URL::to('/admin/lieutrinh/add')}}" style="color: white">Tạo mới liệu trình</a></button>
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh Sách Liệu Trình
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
            <th>Tên Vaccine</th>
            <th>Tháng Tuổi</th>
            <th>Mũi Thứ</th>
            <th>Chức Năng</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_lieutrinh as $key => $lieutrinh)
          <tr>
            <td>{{ $key+1 }}</td>
            @foreach($all_vaccine as $vaccine)
              @if($lieutrinh->vaccine_id == $vaccine->id)
                <td>{{ $vaccine->tenVaccine }}</td>
              @endif
            @endforeach
            <td>{{ $lieutrinh->thangTuoi }}</td>
            <td>{{ $lieutrinh->muiTT }}</td>
            <td>
              <a href="{{ route('lieutrinh.edit',$lieutrinh->id)}}" class="active styling-edit" ui-toggle-class="" style="margin: 0px 15px;">
                <i class="fa fa-pencil-square-o text-success text-active"></i>
              </a>
              <a onclick="return confirm('Bạn có chắc là muốn xóa không?')" href="{{ route('lieutrinh.delete',$lieutrinh->id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-trash-o text-danger text"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div style="text-align: center;">{{ $all_lieutrinh->links() }}</div>
    </div>
  </div>
</div>
@endsection