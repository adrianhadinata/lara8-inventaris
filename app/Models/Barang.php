<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = ['id'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function satuan()
    {
        return $this->belongsTo(Satuan::class);
    }

    public function transaksi_masuk()
    {
        return $this->hasMany(Transaksi_masuk::class);
    }

    public function transaksi_keluar()
    {
        return $this->hasMany(Transaksi_masuk::class);
    }
}
