<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $table = 'tb_member';
    protected $keyType = 'string';
    protected $guarded = ['id'];

    public function Transaksi() {
        return $this->hasMany(Transaksi::class,'id_member');
    }
    public function Penjemputan() {
        return $this->hasMany(Penjemputan::class,'id_member');
    }

}
