<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';

    protected $fillable = [
        'nama', 'kategori_id', 'kode', 'deskripsi', 'stok'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
