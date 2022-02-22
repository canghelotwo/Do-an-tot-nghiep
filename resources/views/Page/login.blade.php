@extends('layout')
@section('content')
<div class="pt-2" style="height: 60px;background: #f8f8f8;line-height: 60px;padding-left: 20px;">
   <h2 style="font-weight: 400;">Đăng Nhập</h2>
</div>
<?php
    	$message = Session::get('message-login');
	    if($message){
	        echo '<div class="alert alert-success mt-2"><span>'.$message.'</span></div>';
	        Session::put('message-login',null);
	    }
	?>
<div class="login">
	
	<form action="{{ route('login_user')}}" method="post">
		{{ csrf_field() }}
	  <div class="imgcontainer">
	    <img src="uploads/img/logoboyte.png" alt="Avatar" class="avatar">
	  </div>
	  	
	  <div class="container">
	    <label for="email"><b>Email</b></label>
	    <input type="text" placeholder="Nhập địa chỉ Email" name="email" required>

	    <label for="password"><b>Mật Khẩu</b></label>
	    <input type="password" placeholder="Nhập mật khẩu" name="password" required>
	    <label>
	      <input type="checkbox" checked="checked" name="remember"> Remember me
	    </label>
	    <button type="submit">Đăng Nhập</button>
	    <label class="text-center">
	      <span>Nếu chưa có tài khoản thì <a href="{{URL::to('/dangky')}}">đăng ký tại đây</a></span>
	    </label>
	  </div>
	</form>
</div>
<style type="text/css">
	.login {
	    border: 3px solid #f1f1f1;
	    margin-top: 20px;
	    width: 50%;
	    margin: 5% 25%;
	}
	.login input[type=text], input[type=password] {
	  width: 100%;
	  padding: 12px 20px;
	  margin: 8px 0;
	  display: inline-block;
	  border: 1px solid #ccc;
	  box-sizing: border-box;
	}
	.login button {
	  background-color: #04AA6D;
	  color: white;
	  padding: 14px 20px;
	  margin: 8px 0;
	  border: none;
	  cursor: pointer;
	  width: 100%;
	}
	.login .imgcontainer {
	  text-align: center;
	  margin: 24px 0 12px 0;
	}

	.login img.avatar {
	  width: 40%;
	}
	.login button:hover {
	  opacity: 0.8;
	}
	.login .container {
	  padding: 16px;
	}

	.login span.psw {
	  float: right;
	  padding-top: 16px;
	}

</style>
@endsection