<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbTransaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_transaksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_outlet')->constrained('tb_outlet');
            $table->string('kode_3invoice',100);
            $table->foreignId('id_member')->constrained('tb_member');
            $table->dateTime('tgl');
            $table->dateTime('deadline');
            $table->dateTime('tgl_bayar')->nullable();
            $table->double('biaya_tambahan')->default(0);
            $table->double('diskon')->default(0);
            $table->enum('jenis_diskon',['nominal','persen'])->nullable(0);
            $table->double('pajak')->default(0);
            $table->enum('status',['baru','proses','selesai','diambil'])->nullable();
            $table->enum('dibayar',['dibayar','belum_dibayar']);
            $table->foreignId('id_user')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_transaksi');
    }
}
