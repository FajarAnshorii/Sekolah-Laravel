<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswas')->onDelete('cascade');
            $table->date('tanggal');
            $table->string('kelas', 100);
            $table->enum('status', ['Hadir', 'Tidak Hadir', 'Izin', 'Sakit'])->default('Hadir');
            $table->integer('poin')->default(0);
            $table->text('keterangan')->nullable();
            $table->timestamps();

            // Satu siswa hanya boleh satu record per tanggal
            $table->unique(['mahasiswa_id', 'tanggal']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('absensis');
    }
};
