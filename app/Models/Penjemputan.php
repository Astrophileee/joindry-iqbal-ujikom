<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjemputan extends Model
{
    use HasFactory;
    protected $table = 'tb_penjemputan';
    protected $keyType = 'string';
    protected $guarded = ['id'];
    /**
     * mendapatkan data member dari penjemputan
     *
     * @return \App\Models\Member
     */
    public function Member() {
        return $this->belongsTo(Member::class,'id_member');
    }
}
