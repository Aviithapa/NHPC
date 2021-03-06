<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLevelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('level', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('level_')->nullable();
            $table->integer('level_number')->nullable();
            $table->string('level_nepali')->nullable();
            $table->string('level_code')->nullable();
            $table->tinyInteger('higher_section')->nullable();
            $table->integer('created_by')->nullable();
            $table->tinyInteger('sub_delete')->nullable();
            $table->date('created_date')->nullable();
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
        Schema::dropIfExists('level');
    }
}
