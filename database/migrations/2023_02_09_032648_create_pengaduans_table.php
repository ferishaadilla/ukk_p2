<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();
            $table->string('nik_masyarakat');
            $table->foreign('nik_masyarakat')->references('nik')->on('masyarakats')->onDelete('cascade');
            $table->string('judul_laporan');
            $table->text('isi_laporan');
            $table->string('foto')->nullable();
            $table->enum('status', ['0', 'proses', 'selesai'])->default('0');
            $table->text('tanggapan')->nullable();
            $table->unsignedBigInteger('petugas_id')->nullable();
            $table->foreign('petugas_id')->references('id')->on('petugas')->onDelete('cascade');
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
        Schema::dropIfExists('pengaduans');
    }
};
