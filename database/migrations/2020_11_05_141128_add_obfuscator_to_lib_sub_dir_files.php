<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddObfuscatorToLibSubDirFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lib_sub_dir_files', function (Blueprint $table) {
            $table->string('obfuscator')->after('file_extension');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lib_sub_dir_files', function (Blueprint $table) {
            $table->dropColumn('obfuscator');
        });
    }
}
