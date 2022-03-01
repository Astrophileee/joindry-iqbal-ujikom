<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;
    protected $table = 'tb_detail_transaksi';
    protected $keyType = 'string';
    protected $guarded = ['id'];

    public function transaksi() {
        return $this->hasMany(Transaksi::class,'id_transaksi');
    }
    public function paket() {
        return $this->belongsTo(Paket::class,'id_paket');
    }

    
}
