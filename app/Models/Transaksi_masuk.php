<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi_masuk extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = ['id'];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
