<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\DBAL\TimestampType;
use Illuminate\Database\Migrations\Migration;

class CreateTbLogging extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_logging', function (Blueprint $table) {
            $table->id();
            $table->string('aksi',50);
            $table->dateTime('waktu')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();
        });

        DB::unprepared(
            'CREATE TRIGGER `INSERT PENGGUNAAN BARANG`
                AFTER INSERT ON `tb_barang` FOR EACH ROW
                BEGIN
                    INSERT INTO `tb_logging` (`aksi`) VALUES("INSERT DATA DALAM TABLE PENGGUNAAN BARANG");
                END');
        DB::unprepared(
            'CREATE TRIGGER `UPDATE PENGGUNAAN BARANG`
                AFTER UPDATE ON `tb_barang` FOR EACH ROW
                BEGIN
                    INSERT INTO `tb_logging` (`aksi`) VALUES("UPDATE DATA DALAM TABLE PENGGUNAAN BARANG");
                END');
        DB::unprepared(
            'CREATE TRIGGER `DELETE PENGGUNAAN BARANG`
                BEFORE DELETE ON `tb_barang` FOR EACH ROW
                BEGIN
                    INSERT INTO `tb_logging` (`aksi`) VALUES("DELETE DATA DALAM TABLE PENGGUNAAN BARANG");
                END');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_logging');
        DB::unprepared('DROP TRIGGER IF EXISTS `INSERT PENGGUNAAN BARANG`');
        DB::unprepared('DROP TRIGGER IF EXISTS `UPDATE PENGGUNAAN BARANG`');
        DB::unprepared('DROP TRIGGER IF EXISTS `DELETE PENGGUNAAN BARANG`');
    }
}
