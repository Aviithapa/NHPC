<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamRegistrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_registration', function (Blueprint $table) {
            $table->id();
            $table->string('exam_id')->nullable();
            $table->string('profile_id')->nullable();
            $table->string('voucher_image')->nullable();
            $table->string('remarks')->nullable();
            $table->integer('subject_committee_count')->nullable();
            $table->integer('level_id')->nullable();
            $table->integer('program_id')->nullable();
            $table->integer('darta_number')->nullable();
            $table->enum('is_admit_card_generate',['yes','no'])->default('no');
            $table->enum('state', ['computer_operator','registrar','subject_committee','exam_committee','officer','onhold','council'])->nullable();
            $table->enum('status', ['pending','progress','accepted','rejected'])->nullable();
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
        Schema::dropIfExists('exam_registration');
    }
}
