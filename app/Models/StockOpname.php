<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockOpname extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_barang',
        'jumlah',
        'satuan',
        // 'harga',
        'tanggal',
    ];
    protected $casts = [
        'tanggal' => 'date',
    ];
}
