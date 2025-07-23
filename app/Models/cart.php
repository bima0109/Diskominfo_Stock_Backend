<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_stock_opname',
        'jumlah',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function stockOpname()
    {
        return $this->belongsTo(StockOpname::class, 'id_stock_opname');
    }
}
