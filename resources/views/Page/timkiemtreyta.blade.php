@extends('layout')
@section('content')
<div class="pt-2" style="height: 60px;background: #f8f8f8;line-height: 60px; padding-left: 20px;">
   <h2 style="font-weight: 400;">TÌM KIẾM THÔNG TIN TRẺ ĐÃ ĐƯỢC DUYỆT TIÊM</h2>
</div>
<div>
  <form action="{{ route('xulytt')}}" method="post">
    {{ csrf_field() }}
    <?php
        $message = Session::get('message-xulytt');
        if($message){
            echo '<div class="alert alert-success mt-2"><span>'.$message.'</span></div>';
            Session::put('message-xulytt',null);
        }
    ?>
    <div class="container" style="margin-left: 25%;margin-top: 10%;">
      <label>Nhập mã đăng ký tiêm chủng:</label>
      <input type="text" placeholder="Nhập mã đăng ký" name="madk" required>
      <button type="submit"><i class="fa fa-arrow-right" aria-hidden="true"></i></button>
    </div>
  </form>
</div>
@endsection