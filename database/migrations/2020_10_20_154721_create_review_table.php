<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review', function (Blueprint $table) {
            $table->bigIncrements('id_review');
            $table->unsignedBigInteger('id_pengajuan');
            $table->boolean('status')->nullable();
            $table->boolean('status_dupak')->nullable();
            $table->boolean('status_pak')->nullable();
            $table->boolean('status_sk')->nullable();
            $table->string('pesan_revisi')->nullable();
            $table->date('tanggal_tolak')->nullable();
            $table->date('tanggal_konfirmasi')->nullable();
            $table->string('pesan_revisi_dupak')->nullable();
            $table->date('tanggal_tolak_dupak')->nullable();
            $table->date('tanggal_konfirmasi_dupak')->nullable();
            $table->string('pesan_revisi_pak')->nullable();
            $table->date('tanggal_tolak_pak')->nullable();
            $table->date('tanggal_konfirmasi_pak')->nullable();
            $table->string('pesan_revisi_sk')->nullable();
            $table->date('tanggal_tolak_sk')->nullable();
            $table->date('tanggal_konfirmasi_sk')->nullable();
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
        Schema::dropIfExists('review');
    }
}
