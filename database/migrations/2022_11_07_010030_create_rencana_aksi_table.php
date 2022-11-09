<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRencanaAksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rencana_aksi', function (Blueprint $table) {
            $table->id();

            $table->foreignId('kegiatan_id')->constrained('kegiatan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('skpd_id')->constrained('skpd')->onDelete('cascade')->onUpdate('cascade');
            $table->date('tanggal')->nullable();
            $table->string('kode');
            $table->string('nama_renaksi')->nullable();
            $table->string('penanggung_jawab')->nullable(); //skpd id
            $table->string('periode'); //B03 B06 B09
            $table->string('status');

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
        Schema::dropIfExists('rencana_aksi');
    }
}
