<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddKomtingToUsersRoleEnum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('Admin','Guru','Staf','Murid','Orang Tua','Alumni','Guest','Perpustakaan','PPDB','Bendahara','Komting') NULL;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Change back to original, but note that any 'Komting' users would cause issue or be set to empty/error if they exist, so we should be careful.
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('Admin','Guru','Staf','Murid','Orang Tua','Alumni','Guest','Perpustakaan','PPDB','Bendahara') NULL;");
    }
}
