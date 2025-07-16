<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permintaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_surat',
        'nama_barang',
        'jumlah',
        'satuan',
        'id_stock_opname',
        'tanggal',
        'keterangan',
        'id_bidang',
        'id_user',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'id_bidang');
    }

    public function stockOpname()
    {
        return $this->belongsTo(StockOpname::class, 'id_stock_opname');
    }
}
