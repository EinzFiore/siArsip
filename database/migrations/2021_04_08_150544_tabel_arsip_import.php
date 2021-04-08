<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TabelArsipImport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_importarsip', function (Blueprint $table) {
            $table->id();
            $table->string('no_pen');
            $table->date('tanggal_dok');
            $table->string('nama_perusahaan');
            $table->string('jenis_dok');
            $table->integer('rak');
            $table->string('box');
            $table->integer('batch');
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
        //
    }
}