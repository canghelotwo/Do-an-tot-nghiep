@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <button type="button" class="btn btn-success" style="margin-bottom: 10px;width: 200px;height: 40px;font-size: 18px"><a href="{{URL::to('/admin/account/add')}}" style="color: white">Tạo mới tài khoản</a></button>
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh Sách Tài Khoản
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
            <th style="text-align: center;">STT</th>
            <th style="text-align: center;">Tên Tài Khoản</th>
            <th style="text-align: center;">Tên Người Dùng</th>
            <th style="text-align: center;">SĐT</th>
            <th style="text-align: center;">Vai Trò</th>
            <th style="text-align: center;">Chức Năng</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_user as $key=>$user)
          <tr>
            <td style="text-align: center;">{{ $key+1 }}</td>
            <td style="text-align: center;">{{ $user->email }}</td>
            <td style="text-align: center;">{{ $user->name }}</td>
            <td style="text-align: center;">{{ $user->SDT }}</td>
            @foreach($all_role as $role)
              @if($user->role_id == $role->id)
                <td style="text-align: center;">{{ $role->name }}</td>
              @endif
            @endforeach
            <td style="text-align: center;">
              <a href="{{ route('user.edit',$user->id)}}" class="active styling-edit" ui-toggle-class="" style="margin: 0px 15px;">
                <i class="fa fa-pencil-square-o text-success text-active"></i>
              </a>
              <a onclick="return confirm('Bạn có chắc là muốn xóa không?')" href="{{ route('user.delete',$user->id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-trash-o text-danger text"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div style="text-align: center;">{{ $all_user->links() }}</div>
    </div>
  </div>
</div>
@endsection