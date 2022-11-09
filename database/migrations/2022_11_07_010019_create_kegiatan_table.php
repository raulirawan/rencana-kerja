<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKegiatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->id();

            $table->foreignId('monitor_id')->constrained('monitor')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('sasaran_id')->constrained('sasaran_strategis')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama_kegiatan')->nullable();
            $table->string('kategori')->nullable();
            $table->date('periode_awal')->nullable();
            $table->date('periode_akhir')->nullable();

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
        Schema::dropIfExists('kegiatan');
    }
}
