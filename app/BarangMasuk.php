<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    public $incrementing = true;
    protected $table = 'barang_masuk';

    protected $fillable = [
        'nama_barang',
        'deskripsi',
        'image',
        'qty',
        'harga_barang',
    ];
}
