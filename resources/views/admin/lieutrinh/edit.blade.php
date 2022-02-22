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
                    @foreach($edit_lieutrinh as $key => $lieutrinh)
                    <form role="form" action="{{ route('lieutrinh.update', $lieutrinh->id)}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tháng Tuổi</label>
                            <input type="text" name="thangtuoi" class="form-control" id="exampleInputEmail1" placeholder="Nhập Tháng Tuổi Được Tiêm" required="true" value="{{ $lieutrinh->thangTuoi}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mũi Tiêm Thứ</label>
                            <input type="text" data-validation="length" data-validation-length="min10" data-validation-error-msg="Làm ơn điền ít nhất 10 ký tự" name="muitt" class="form-control" id="exampleInputEmail1" placeholder="Nhập Mũi Tiêm Thứ" required="true" value="{{ $lieutrinh->muiTT}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Vaccine</label>
                            <select name="vaccine_id" class="form-control input-sm m-bot15" >
                                @foreach($all_vaccine as  $vaccine)
                                    @if($vaccine->id == $lieutrinh->vaccine_id)
                                    <option selected value="{{$vaccine->id}}">{{$vaccine->tenVaccine}}</option>
                                    @else
                                    <option value="{{$vaccine->id}}">{{$vaccine->tenVaccine}}</option>
                                    @endif
                                @endforeach
                            </select>
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