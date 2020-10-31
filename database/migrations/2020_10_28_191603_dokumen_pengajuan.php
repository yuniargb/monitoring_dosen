<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DokumenPengajuan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DokumenPengajuan', function (Blueprint $table) {
            $table->bigIncrements('id_dokumen_pengajuan');
            $table->unsignedBigInteger('id_pengajuan');
            $table->text('dokumen');
            $table->string('jenis');
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
        Schema::dropIfExists('DokumenPengajuan');
    }
}
