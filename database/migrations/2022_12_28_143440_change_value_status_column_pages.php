<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeValueStatusColumnPages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pages', function (Blueprint $table) {
            DB::statement("ALTER TABLE pages MODIFY status ENUM('Đợi duyệt','Công khai')");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pages', function (Blueprint $table) {
            DB::statement("ALTER TABLE pages MODIFY status ENUM('Đợi duyệt','Công khai')");
        });
    }
}
