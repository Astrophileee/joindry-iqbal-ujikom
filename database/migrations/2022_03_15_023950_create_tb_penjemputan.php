<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbPenjemputan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_penjemputan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_member')->constrained('tb_member');
            $table->string('petugas');
            $table->enum('status',['tercatat','penjemput','selesai'])->default('tercatat');
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
        Schema::dropIfExists('tb_penjemputan');
    }
}
