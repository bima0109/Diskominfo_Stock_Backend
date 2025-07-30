<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BarangMasih extends Model
{
    use hasFactory;

    protected $fillable = [
        'nama_barang',
        'jumlah',
        'satuan',
        'tanggal',
        
    ];
}
