<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('FirstName');
            $table->string('SurName');
            $table->string('MiddleName')->nullable();
            $table->string('ClassID');
            $table->string('ParentName');
            $table->bigInteger('ParentContact');
            $table->integer('SchoolID');
            $table->date('DOB');
            $table->integer('AddedBy');
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
        Schema::dropIfExists('students');
    }
}
