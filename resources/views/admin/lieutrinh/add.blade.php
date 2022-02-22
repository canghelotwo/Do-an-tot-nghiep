@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
               Tạo mới liệu trình
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
                    <form role="form" action="{{ route('lieutrinh.save')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tháng Tuổi</label>
                            <input type="text" name="thangtuoi" class="form-control" id="exampleInputEmail1" placeholder="Nhập Tháng Tuổi Được Tiêm" required="true">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mũi Tiêm Thứ</label>
                            <input type="text" data-validation="length" data-validation-length="min10" data-validation-error-msg="Làm ơn điền ít nhất 10 ký tự" name="muitt" class="form-control" id="exampleInputEmail1" placeholder="Nhập Mũi Tiêm Thứ" required="true">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Vaccine</label>
                            <select name="vaccine_id" class="form-control input-sm m-bot15" >
                                @foreach($all_vaccine as  $vaccine)
                                    <option selected value="{{$vaccine->id}}">{{$vaccine->tenVaccine}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit"class="btn btn-info">Thêm Liệu Trình</button>
                    </form>
                </div> 
            </div>
        </section>
    </div>
</div>
@endsection