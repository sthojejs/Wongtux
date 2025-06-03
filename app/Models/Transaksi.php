<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Barang;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $fillable = ['barang_id', 'jenis', 'jumlah', 'keterangan', 'supplier_id'];

        public function barang()
    {
        return $this->belongsTo(\App\Models\Barang::class);
    }

    public function supplier()
    {
        return $this->belongsTo(\App\Models\Supplier::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

}
