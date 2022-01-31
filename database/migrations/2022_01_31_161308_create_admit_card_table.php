<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmitCardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admit_card', function (Blueprint $table) {
            $table->id();
            $table->integer('profile_id')->nullable();
            $table->integer('exam_processing_id')->nullable();
            $table->integer('symbol_number')->nullable();
            $table->string('is_taken')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('admit_card');
    }
}
