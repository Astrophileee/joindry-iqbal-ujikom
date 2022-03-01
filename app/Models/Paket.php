<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;
    protected $table = 'tb_paket';
    protected $keyType = 'string';
    protected $guarded = ['id'];
    
    public function Outlet() {
        return $this->belongsTo(Outlet::class,'id_outlet');
    }
    public function DetailTransaksi() {
        return $this->hasMany(DetailTransaksi::class,'id_paket');
    }
}
