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
    /**
     * mendapatkan data outlet dari transaksi
     *
     * @return \App\Models\Outlet
     */
    public function Outlet() {
        return $this->belongsTo(Outlet::class,'id_outlet');
    }
    /**
     * mendapatkan data member dari transaksi
     *
     * @return \App\Models\Member
     */
    public function Member() {
        return $this->belongsTo(Member::class,'id_member');
    }
    /**
     * mendapatkan data userdari transaksi
     *
     * @return \App\Models\User
     */
    public function User() {
        return $this->belongsTo(User::class,'id_user');
    }
    /**
     * //mendapatkan data detail transaksi dari transaksi
     *
     * @return \App\Models\DetailTransaksi
     */
    public function detailtransaksi() {
        return $this->hasMany(DetailTransaksi::class,'id_transaksi');
    }
    /**
     * membuat kode invoice transaksi
     *
     * @return int
     */
    public static function createInvoice()
    {
        $lastNumber = self::selectRaw("IFNULL(MAX(SUBSTRING(`kode_invoice`,9,5)),0) + 1 AS last_number")->whereRaw("SUBSTRING(`kode_invoice`,1,4) = '" . date('Y') . "'")->whereRaw("SUBSTRING(`kode_invoice`,5,2) = '" . date('m') . "'")->orderBy('last_number')->first()->last_number;
        $invoice = date("Ymd") . sprintf("%'.05d", $lastNumber);
        return $invoice;
    }
    /**
     * menghitung total harga transaks
     *
     * @return int
     */
    public function getTotalHarga()
    {
        return $this->detailtransaksi->reduce(function ($total, $detail) {
            return $total + ($detail->paket->harga * $detail->qty);
        });
    }
    /**
     * menghitung diskon transaksi
     *
     * @return int
     */
    public function getTotalDiskon()
    {
        return $this->getTotalHarga() * ($this->diskon / 100);
    }
    /**
     * menghitung total pajak transaksi
     *
     * @return int
     */
    public function getTotalPajak()
    {
        return $this->getTotalHarga() * ($this->pajak / 100);
    }
    /**
     * menghitung toital pembayaran transaksi
     *
     * @return int
     */
    public function getTotalPembayaran()
    {
        return $this->getTotalHarga() - $this->getTotalDiskon() + $this->getTotalPajak() + $this->biaya_tambahan;
    }

}
