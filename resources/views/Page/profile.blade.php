@extends('layout')
@section('content')
<div class="pt-2" style="height: 60px;background: #f8f8f8;line-height: 60px; padding-left: 20px;">
   <h2 style="font-weight: 400;">Thông Tin Tài Khoản</h2>
</div>
<?php
    $message = Session::get('message-profile');
    if($message){
        echo '<div class="alert alert-success mt-2"><span>'.$message.'</span></div>';
        Session::put('message-profile',null);
    }
?>
<div class="sigup">
	<h2 class="text-center mt-2">Cập nhật thông tin cá nhân</h2>
	<form action="{{ route('update.profile',Auth::user()->id)}}" method="post"> 
		{{ csrf_field() }}
	  	<div class="form-row">
		    <div class="form-group mt-2">
		      <label for="name"><b>Tên Người Dùng</b></label>
		      <input type="text" class="form-control mt-1" id="name" name="name" placeholder="Nhập tên người dùng" value="{{Auth::user()->name}}">
		    </div>
		    <div class="form-group mt-2">
		      	<label for="sdt"><b>Số Điện Thoại</b></label>
		    	<input type="text" class="form-control mt-1" placeholder="Nhập số điện thoại" id="sdt" name="sdt" required value="{{Auth::user()->SDT}}">
		    </div>
		  	<!-- <div class="form-group mt-2">
		      <label for="gioitinh"><b>Giới Tính</b></label>
		      <select id="gioitinh" class="form-control mt-1" name="gioitinh" >
		        <option value="Nam">Nam</option>
		        <option value="Nữ">Nữ</option>
		        <option value="Khác">Khác</option>
		      </select>
		    </div> -->
		  	<!-- <div class="form-group mt-2">
			    <label for="email"><b></b></label>
			    <input type="text" class="form-control mt-1" placeholder="Nhập địa chỉ Email" id="email" name="email" required value="{{Auth::user()->email}}">
		  	</div> -->
		</div>
	  	<button type="submit" class="btn btn-primary mt-3 mb-2 w-100" style="height: 52px">Cập Nhật</button>
	  	<label class="text-center">
	      <span>Bạn muốn thay đổi mật khẩu hãy <a href="{{URL::to('/updatepassword')}}">nhấn vào đây</a></span>
	    </label>
	</form>
</div>
<style type="text/css">
	.sigup {
	    border: 3px solid #f1f1f1;
	    margin-top: 20px;
	    width: 50%;
	    margin: 5% 25%;
	}
	.sigup form {
		padding: 20px;
	}
</style>
@endsection