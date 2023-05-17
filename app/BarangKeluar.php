<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    public $incrementing = true;
    protected $table = 'barang_keluar';

    protected $fillable = [
        'nama_barang',
        'deskripsi',
        'image',
        'qty',
        'harga_barang',
    ];
}
