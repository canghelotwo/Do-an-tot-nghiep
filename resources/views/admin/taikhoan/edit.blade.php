@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
               Sửa Tài Khoản
            </header>
             <?php
                $message = Session::get('message');
                if($message){
                    echo '<span class="text-alert">'.$message.'</span>';
                    Session::put('message',null);
                }
                ?>
            <div class="panel-body">
                <div class="position-center">
                    @foreach($edit_user as $key => $user)
                    <form role="form" action="{{ route('user.update', $user->id)}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="text" data-validation="length" data-validation-length="min10" data-validation-error-msg="Làm ơn điền ít nhất 10 ký tự" name="email" class="form-control" id="exampleInputEmail1" placeholder="Nhập Email" required="true" value="{{$user->email}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên Người Dùng</label>
                            <input type="text" data-validation="length" data-validation-length="min10" data-validation-error-msg="Làm ơn điền ít nhất 10 ký tự" name="name" class="form-control" id="exampleInputEmail1" placeholder="Nhập Tên Người Dùng" required="true" value="{{$user->name}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số Điện Thoại</label>
                            <input type="text" data-validation="length" data-validation-length="min10" data-validation-error-msg="Làm ơn điền ít nhất 10 ký tự" name="sdt" class="form-control" id="exampleInputEmail1" placeholder="Nhập SDT" required="true" value="{{$user->SDT}}" >
                        </div>
                        <!-- <div class="form-group">
                            <label for="exampleInputEmail1">Giới Tính</label>
                            <select name="gioitinh" class="form-control input-sm m-bot15" value="{{$user->gioiTinh}}">
                                <option>
                                    <option selected value="Nam">Nam</option> 
                                    <option  value="Nữ">Nữ</option>
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Địa Chỉ</label>
                            <input type="text" data-validation="length" data-validation-length="min10" data-validation-error-msg="Làm ơn điền ít nhất 10 ký tự" name="diachi" class="form-control" id="exampleInputEmail1" placeholder="Nhập Địa Chỉ" required="true" value="{{$user->diaChi}}">
                        </div> -->
                        <div class="form-group">
                            <label for="exampleInputEmail1">Vai Trò</label>
                            <select name="role_id" class="form-control input-sm m-bot15" >
                                @foreach($all_role as  $role)
                                    @if($role->id == $user->role_id)
                                    <option selected value="{{$role->id}}">{{$role->name}}</option>
                                    @else
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" name="edit_user"  class="btn btn-info">Sửa</button>
                    </form>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
</div>
@endsection