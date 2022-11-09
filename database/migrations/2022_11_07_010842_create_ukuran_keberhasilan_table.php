<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUkuranKeberhasilanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ukuran_keberhasilan', function (Blueprint $table) {
            $table->id();

            $table->foreignId('rencana_aksi_id')->constrained('rencana_aksi')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('bulan')->nullable(); //bulan ke 1 2 3
            $table->string('periode')->nullable();
            $table->integer('capaian')->nullable();
            $table->string('ukuran_keberhasilan')->nullable();
            $table->text('target_capaian')->nullable();
            $table->string('nilai_pemantau');
            $table->longText('keterangan');
            $table->text('catatan');
            $table->text('file_pendukung');

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
        Schema::dropIfExists('ukuran_keberhasilan');
    }
}
