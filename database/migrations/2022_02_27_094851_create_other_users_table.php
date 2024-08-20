<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOtherUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('other_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email')->unique();
            $table->string('name');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('validity');
            $table->integer('UserRole');
            $table->integer('TeacherID')->nullable();
            $table->integer('StudentID')->nullable();
            $table->string('Obfuscator')->unique();
            $table->rememberToken();
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
        Schema::dropIfExists('other_user');
    }
}
