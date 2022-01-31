<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    use HasFactory;
    protected $table = 'tb_outlet';
    protected $keyType = 'string';
    protected $guarded = ['id'];

    public function Paket() {
        return $this->hasMany(Paket::class,'id_outlet');
    }

    public function User() {
        return $this->hasMany(User::class,'id_outlet');
    }

    public function canDelete(){
        return !$this->Paket()->exists();
    }
}
