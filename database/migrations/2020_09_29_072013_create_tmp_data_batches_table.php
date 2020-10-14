<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTmpDataBatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tmp_data_batches', function (Blueprint $table) {
            $table->id('id_tmp');
            $table->string('nama_pt');
            $table->string('batch');
            $table->integer('no_batch');
            $table->year('tahun_batch');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tmp_data_batches');
    }
}
