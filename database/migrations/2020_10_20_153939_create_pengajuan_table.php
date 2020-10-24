<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengajuanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->bigIncrements('id_pengajuan');
            $table->text('foto_1');
            $table->text('foto_2');
            $table->text('foto_3');
            $table->text('foto_4');
            $table->string('nama');
            $table->string('alamat');
            $table->string('nidn');
            $table->unsignedBigInteger('id_fakultas');
            $table->unsignedBigInteger('id_prodi');
            $table->boolean('status');
            $table->string('pesan_revisi')->nullable();
            $table->date('tanggal_tolak')->nullable();
            $table->date('tanggal_konfirmasi')->nullable();
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
        Schema::dropIfExists('pengajuan');
    }
}
