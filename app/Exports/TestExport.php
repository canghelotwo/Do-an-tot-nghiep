<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\DangKyTiem;
use Illuminate\Support\Facades\DB;
class TestExport implements FromCollection,WithHeadings
{
	/**
     * Set header columns
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID Trẻ',
            'ID Vaccine',
            'ID Đợt Tiêm',
            'Ngày Đăng Ký',
            'Mũi Thứ',
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct(int $id) {
    	$this->id = $id;
    }
    public function collection()
    {
        // return DangKyTiem::where('dottiem_id',$this->id)->get();
        return DangKyTiem::select('kid_id', 'vaccine_id', 'dottiem_id','NgayDK','MuiThu')
                           ->where('dottiem_id', '=', $this->id)
                           ->where('TinhTrang','Đợi Duyệt')
                           ->get();

        // dd( DB::select("SELECT kids.name,vaccines.tenVaccine,dottiem.tenDiaDiem,dangkytiem.NgayDK,dangkytiem.MuiThu,dangkytiem.TinhTrang FROM dangkytiem Join kids ON dangkytiem.kid_id = kids.id Join vaccines ON vaccines.id = dangkytiem.vaccine_id join dottiem ON dottiem.id = dangkytiem.dottiem_id WHERE dangkytiem.dottiem_id = $this->id"));

    }
}
