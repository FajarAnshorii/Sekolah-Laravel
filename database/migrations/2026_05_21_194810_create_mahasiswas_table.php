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
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nim', 50)->unique();
            $table->string('program_studi');
            $table->string('kelas', 100);
            $table->string('email')->unique();
            $table->string('no_hp', 20)->nullable();
            $table->enum('status', ['Aktif', 'Tidak Aktif'])->default('Aktif');
            $table->decimal('k1', 5, 2)->nullable();
            $table->decimal('k2', 5, 2)->nullable();
            $table->decimal('k3', 5, 2)->nullable();
            $table->decimal('k4', 5, 2)->nullable();
            $table->decimal('mid', 5, 2)->nullable();
            $table->decimal('uas', 5, 2)->nullable();
            $table->decimal('remidi', 5, 2)->nullable();
            $table->decimal('total', 8, 4)->nullable();
            $table->string('nilai_akhir', 5)->nullable();
            $table->decimal('bobot_nilai', 3, 1)->nullable();
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
        Schema::dropIfExists('mahasiswas');
    }
};
