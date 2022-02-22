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
                    @foreach($edit_dottiem as $key => $dottiem)
                    <form role="form" action="{{ route('dottiem.update', $dottiem->id)}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên Địa Điểm</label>
                            <input type="text" data-validation="length" data-validation-length="min10" data-validation-error-msg="Làm ơn điền ít nhất 10 ký tự" name="diadiem" class="form-control" id="exampleInputEmail1" placeholder="Nhập Địa Điểm" required="true" value="{{$dottiem->tenDiaDiem}}" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Ngày Bắt Đầu</label>
                            <input type="date" data-validation="length" data-validation-length="min10" data-validation-error-msg="Làm ơn điền ít nhất 10 ký tự" name="ngaybd" class="form-control" id="exampleInputEmail1" placeholder="Ngày Bắt Đầu" required="true" value="{{$dottiem->ngayBD}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Ngày Kết Thúc</label>
                            <input type="date" data-validation="length" data-validation-length="min10" data-validation-error-msg="Làm ơn điền ít nhất 10 ký tự" name="ngaykt" class="form-control" id="exampleInputEmail1" placeholder="Ngày Kết Thúc" required="true" value="{{$dottiem->ngayKT}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Phường/Xã</label>
                            <select name="phuongxa_id" class="form-control input-sm m-bot15" >
                                @foreach($phuongxa as  $px)
                                    @if($px->id == $dottiem->phuongxa_id)
                                    <option selected value="{{$px->id}}">{{$px->name}}</option>
                                    @else
                                    <option value="{{$px->id}}">{{$px->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <button type="submit"  class="btn btn-info">Sửa</button>
                    </form>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
</div>
@endsection