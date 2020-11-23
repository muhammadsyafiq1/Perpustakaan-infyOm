<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('image')->nullable();
            $table->longText('address')->nullable();
            $table->string('age')->nullable();
            $table->string('nationality')->nullable();
            $table->string('current_school')->nullable();
            $table->string('class')->nullable();
            $table->date('bod')->nullable();
            $table->date('registered')->nullable();
            $table->date('exp_resgiter')->nullable();
            $table->integer('no_hp')->nullable();
            $table->unsignedBigInteger('borrow_id');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('borrow_id')->references('id')->on('borrow')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
