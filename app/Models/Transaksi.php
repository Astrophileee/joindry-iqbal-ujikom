<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'tb_transaksi';
    protected $keyType = 'string';
    protected $guarded = ['id'];

    public function Outlet() {
        return $this->belongsTo(Outlet::class,'id_outlet');
    }
    public function Member() {
        return $this->belongsTo(Member::class,'id_member');
    }
    public function User() {
        return $this->belongsTo(User::class,'id_user');
    }
    public function detailtransaksi() {
        return $this->hasMany(DetailTransaksi::class,'id_transaksi');
    }

    public static function createInvoice()
    {
        $lastNumber = self::selectRaw("IFNULL(MAX(SUBSTRING(`kode_invoice`,9,5)),0) + 1 AS last_number")->whereRaw("SUBSTRING(`kode_invoice`,1,4) = '" . date('Y') . "'")->whereRaw("SUBSTRING(`kode_invoice`,5,2) = '" . date('m') . "'")->orderBy('last_number')->first()->last_number;
        $invoice = date("Ymd") . sprintf("%'.05d", $lastNumber);
        return $invoice;
    }

    public function getTotalHarga()
    {
        return $this->detailtransaksi->reduce(function ($total, $detail) {
            return $total + ($detail->paket->harga * $detail->qty);
        });
    }

    public function getTotalDiskon()
    {
        return $this->getTotalHarga() * ($this->diskon / 100);
    }

    public function getTotalPajak()
    {
        return $this->getTotalHarga() * ($this->pajak / 100);
    }

    public function getTotalPembayaran()
    {
        return $this->getTotalHarga() - $this->getTotalDiskon() + $this->getTotalPajak() + $this->biaya_tambahan;
    }

}
