<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nonsurats', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->enum('kriteriapemohon',['lsm','bumn-swasta','k-l','sekolah','perguruantinggi','pemerintahdaerah','tni-polri']);
            $table->bigInteger('notlpn');
            $table->string('foto');
            $table->timestamps();
            // $table->id();
            // $table->string('note');
            // $table->string('pic');
            // $table->string('intruksi');
            // $table->string('noorder');
            // $table->string('suratdari');
            // $table->string('instansi');
            // $table->string('alamat');
            // $table->string('penggunaandata');
            // $table->string('kontak');
            // $table->string('notglsrt');
            // $table->enum('jenispermohonan',['petadasar','diklat','hukum','kebencanaan','kerjasama','kunjungan','penelitian']);
            // $table->string('tgltrimakirim');
            // $table->string('tglselesai');
            // $table->bigInteger('notlpn');
            // $table->string('foto');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nonsurats');
    }
};
