<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class verifikasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'status',
        'id_user',
        'id_bidang',
        'menyetujui',
        'tanggal_acc'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'id_bidang');
    }
    public function permintaans()
    {
        return $this->hasMany(Permintaan::class, 'id_verifikasi');
    }
}
