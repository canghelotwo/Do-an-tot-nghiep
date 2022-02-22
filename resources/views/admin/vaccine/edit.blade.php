@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
               Sửa Vaccine
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
                    @foreach($edit_vaccine as $key => $vaccine)
                    <form role="form" action="{{ route('vaccine.update', $vaccine->id)}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên Vaccine</label>
                            <input type="text" data-validation="length" data-validation-length="min10" data-validation-error-msg="Làm ơn điền ít nhất 10 ký tự" name="name" class="form-control" id="exampleInputEmail1" placeholder="Nhập Tên Vaccine" required="true" value="{{$vaccine->tenVaccine}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số Lượng</label>
                            <input type="text" data-validation="length" data-validation-length="min10" data-validation-error-msg="Làm ơn điền ít nhất 10 ký tự" name="sl" class="form-control" id="exampleInputEmail1" placeholder="Nhập Số Lượng" required="true" value="{{$vaccine->soLuong}}">
                        </div>
                        <button type="submit" class="btn btn-info">Sửa</button>
                    </form>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
</div>
@endsection