<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('certificate_name')->nullable();
            $table->string('code')->nullable();
            $table->string('qualification')->nullable();
            $table->integer('level_id')->nullable();
            $table->integer('program_duration')->nullable();
            $table->enum('duration_type', ['month', 'year'])->nullable()->default('year');
            $table->enum('program_type', ['yearly', 'semester','trimester','bulk'])->nullable()->default('yearly');
            $table->integer('created_by')->nullable();
            $table->integer('vacancy_number')->nullable();
            $table->tinyInteger('sub_delete')->nullable();
            $table->tinyInteger('exam')->nullable();
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
        Schema::dropIfExists('program');
    }
}
