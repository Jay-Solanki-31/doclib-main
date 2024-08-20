<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLibSubDirFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lib_sub_dir_files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('file');
            $table->text('description');
            $table->string('file_extension');
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
        Schema::dropIfExists('lib_sub_dir_files');
    }
}
