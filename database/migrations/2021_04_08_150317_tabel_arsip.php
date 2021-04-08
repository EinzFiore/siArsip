<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TabelArsip extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_arsip', function (Blueprint $table) {
            $table->id('id_dok');
            $table->string('no_pen');
            $table->string('nama_pt');
            $table->string('jenis_dok');
            $table->date('tanggal_dok');
            $table->integer('rak');
            $table->string('box');
            $table->string('batch');
            $table->integer('status');
            $table->integer('user_id');
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