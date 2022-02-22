@extends('layout')
@section('content')
<div class="pt-2" style="height: 60px;background: #f8f8f8;line-height: 60px; padding-left: 20px;">
   <h2 style="font-weight: 400;">Thông Tin Tài Khoản</h2>
</div>
<?php
    $message = Session::get('message-password');
    if($message){
        echo '<div class="alert alert-success mt-2"><span>'.$message.'</span></div>';
        Session::put('message-password',null);
    }
?>
<div class="sigup">
	<h2 class="text-center mt-2">Cập nhật thông tin cá nhân</h2>
	<form action="{{ route('update.password',Auth::user()->id)}}" method="post"> 
		{{ csrf_field() }}
	  	<div class="form-row">
		    <div class="form-group mt-2">
		      <label for="password"><b>Mật khẩu mới</b></label>
		      <input type="password" class="form-control mt-1" id="password" name="password" placeholder="Nhập mật khẩu">
		    </div>
		    <div class="form-group mt-2">
		      	<label for="rspassword"><b>Nhập lại mật khẩu mới</b></label>
		    	<input type="password" class="form-control mt-1" placeholder="Nhập mật khẩu mới" id="rspassword" name="rspassword" required>
		    </div>
		</div>
	  	<button type="submit" class="btn btn-primary mt-3 mb-2 w-100" style="height: 52px">Cập Nhật</button>
	  	<label class="text-center">
	      <span>Bạn muốn thay đổi thông tin cá nhân hãy <a href="{{URL::to('/profile')}}">nhấn vào đây</a></span>
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