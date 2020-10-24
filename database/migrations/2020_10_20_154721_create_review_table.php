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
            $table->text('foto_1_r');
            $table->text('foto_2_r');
            $table->text('foto_3_r');
            $table->text('foto_4_r');
            $table->text('foto_5_r');
            $table->text('foto_6_r');
            $table->text('foto_7_r');
            $table->text('foto_8_r');
            $table->text('foto_9_r');
            $table->text('foto_10_r');
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
        Schema::dropIfExists('review');
    }
}
