<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permintaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_barang',
        'jumlah',
        'satuan',
        'kode_barang',
        'keterangan',
        'id_verifikasi',
    ];

    public function stockOpname()
    {
        return $this->belongsTo(StockOpname::class, 'id_stock_opname');
    }
}
