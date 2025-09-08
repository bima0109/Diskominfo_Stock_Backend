<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HistoryStock extends Model
{
    use hasFactory;

    protected $fillable = [
        'nama_barang',
        'jumlah',
        'satuan',
        'harga',
        'tanggal',
        'id_stock'
        // 'stock_opname_id',
    ];
}
