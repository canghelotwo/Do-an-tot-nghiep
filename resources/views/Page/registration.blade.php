@extends('layout')
@section('content')
<div class="pt-2" style="height: 60px;background: #f8f8f8;line-height: 60px; padding-left: 20px;">
   <h2 style="font-weight: 400;">Đăng Ký Tài Khoản</h2>
</div>
<div class="sigup">
	<h2 class="text-center mt-2">Đăng Ký</h2>
	<form action="{{ route('create_user')}}" method="post"> 
		{{ csrf_field() }}
	  	<div class="form-row">
		    <div class="form-group mt-2">
		      <label for="name"><b>Tên Người Dùng</b></label>
		      <input type="text" class="form-control mt-1" id="name" name="name" placeholder="Nhập tên người dùng" autocomplete="new-password">
		    </div>
		    <div class="form-group mt-2">
		      	<label for="sdt"><b>Số Điện Thoại</b></label>
		    	<input type="text" class="form-control mt-1" placeholder="Nhập số điện thoại" id="sdt" name="sdt" required autocomplete="new-password">
		    </div>
		  	<div class="form-group mt-2">
			    <label for="email"><b>Email</b></label>
			    <input type="text" class="form-control mt-1" placeholder="Nhập địa chỉ Email" id="email" name="email" required autocomplete="new-password">
		  	</div>
		  	<div class="form-group mt-2">
		      <label for="password"><b>Mật Khẩu</b></label>
		      <input type="password" class="form-control mt-1" id="password" name="password" placeholder="Nhập mật khẩu" autocomplete="new-password">
		    </div>
		    <div class="form-group mt-2">
		      <label for="rspassword"><b>Nhập Lại Mật Khẩu</b></label>
		      <input type="password" class="form-control mt-1" id="rspassword" name="rspassword" placeholder="Nhập lại mật khẩu" autocomplete="new-password">
		    </div>
		</div>
	  	<button type="submit" class="btn btn-primary mt-3 mb-2 w-100" style="height: 52px">Đăng Ký</button><br>
	  	<label class="text-center">
	      <span>Nếu đã có tài khoản xin mời <a href="{{URL::to('/dangnhap')}}">đăng nhập</a></span>
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