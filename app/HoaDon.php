<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HoaDon extends Model
{

    const STATUS = ['Hủy', 'Mới', 'Đã nhập chỉ số', 'Đã in hóa đơn', 'Đã nạp tiền'];

    protected $table = 'hoa_don';

    protected $fillable = ['ma_dksd_dien', 'chi_so_cu', 'chi_so_moi', 'thue_gtgt', 'tong_tien', 'tu_ngay', 'den_ngay', 'trang_thai'];

    protected $dates = ['created_at', 'updated_at'];

    protected $primaryKey = 'ma_hoa_don';

    public function ho_so()
    {
        return $this->belongsTo(DKSDDien::class, 'ma_dksd_dien', 'ma_dksd_dien');
    }
}