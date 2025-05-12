<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'supplier';
    protected $fillable = ['nama', 'kontak', 'email', 'alamat'];

    public function transaksi()
    {
        return $this->hasMany(\App\Models\Transaksi::class);
    }
}
