<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermintaanSuratsTable extends Migration
{
    public function up()
    {
        Schema::create('permintaan_surats', function (Blueprint $table) {
            $table->id();
            $table->string('penerima');
            $table->string('perihal');
            $table->string('agenda');
            $table->date('tanggal');
            $table->time('waktu');
            $table->string('tempat');
            $table->unsignedBigInteger('send_to');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('permintaan_surats');
    }
}