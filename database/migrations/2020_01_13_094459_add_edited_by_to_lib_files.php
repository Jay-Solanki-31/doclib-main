<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEditedByToLibFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lib_files', function (Blueprint $table) {
            $table->bigInteger('edited_by')->unsigned()->nullable()->after('user_id');
            $table->foreign('edited_by')->references('id')->on('users')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lib_files', function (Blueprint $table) {
            $table->dropColumn('edited_by');
        });
    }
}
