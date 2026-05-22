<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Tabel penghargaans
        Schema::create('penghargaans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mahasiswa_id');
            $table->string('nama_penghargaan');
            $table->string('tingkat');
            $table->string('penyelenggara');
            $table->date('tanggal')->nullable();
            $table->string('file_sertifikat')->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamps();

            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswas')->onDelete('cascade');
        });

        // Tabel sertifikats
        Schema::create('sertifikats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mahasiswa_id');
            $table->string('nama_sertifikat');
            $table->string('tingkat');
            $table->string('penyelenggara');
            $table->date('tanggal')->nullable();
            $table->string('jenis')->nullable();
            $table->integer('jumlah_jam')->nullable();
            $table->string('file_sertifikat')->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamps();

            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswas')->onDelete('cascade');
        });

        // Tabel perlombaans
        Schema::create('perlombaans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mahasiswa_id');
            $table->string('nama_perlombaan');
            $table->string('tingkat');
            $table->string('penyelenggara');
            $table->string('juara')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('file_sertifikat')->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamps();

            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswas')->onDelete('cascade');
        });

        // Tabel portofolios
        Schema::create('portofolios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mahasiswa_id');
            $table->string('judul');
            $table->string('kategori')->nullable();
            $table->string('link')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('file_portofolio')->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamps();

            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('portofolios');
        Schema::dropIfExists('perlombaans');
        Schema::dropIfExists('sertifikats');
        Schema::dropIfExists('penghargaans');
    }
};
