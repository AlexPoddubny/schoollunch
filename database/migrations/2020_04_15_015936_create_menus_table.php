<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->unsignedBigInteger('school_id');
            $table->unsignedBigInteger('break_id');
            $table->unsignedBigInteger('lunch_id')->nullable();
            $table->boolean('privileged')->default(false);
            $table->foreign('school_id')->references('id')->on('schools');
            $table->foreign('break_id')->references('id')->on('breaks');
            $table->foreign('lunch_id')->references('id')->on('lunches');
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
        Schema::dropIfExists('menus');
    }
}
