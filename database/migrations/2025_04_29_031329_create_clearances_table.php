<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clearances', function (Blueprint $table) {
            $table->id();
            $table->string('instansi');
            $table->string('nama_kegiatan');
            $table->date('tanggal');
            $table->string('nomor_surat');
            $table->string('sifat_surat');
            $table->string('lampiran')->nullable();
            $table->string('hal');
            $table->string('nama_penelaah');
            $table->string('jabatan_penelaah');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clearances');
    }
};
