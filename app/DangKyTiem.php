<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DangKyTiem extends Model
{
    protected $fillable = [
        'vaccine_id', 'dottiem_id', 'kid_id', 'ngayDK', 'bacsi_id', 'yta_id','TinhTrang','NgayTiem','MuiThu','BacSiTuVan',''
    ];
    protected $primaryKey = 'id';
    protected $table = 'dangkytiem';	
}
