<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationProcessing extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registration_processing', function (Blueprint $table) {
            $table->id();
            $table->integer('registration_id')->nullable();
            $table->integer('darta_number');
            $table->enum('registration_type', ['old','new'])->nullable();
            $table->string('comment')->nullable();
            $table->enum('current_state', ['computer_operator','registrar','subject_committee','exam_committee','officer','onhold','council'])->nullable();
            $table->enum('current_status', ['pending','progress','accepted','rejected'])->nullable();
            $table->tinyInteger('status')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('review_status')->nullable();
            $table->tinyInteger('sub_delete')->nullable();
            $table->date('created_date')->nullable();
            $table->integer('approval_subject')->nullable();
            $table->integer('approval_exam')->nullable();
            $table->integer('approval_council')->nullable();
            $table->integer('approval_levels')->nullable();
            $table->enum('check_state', ['computer_operator','registrar','subject_committee','exam_committee','officer','onhold','council'])->nullable();
            $table->string('subject_committee_minute')->nullable();
            $table->integer('routing_number')->nullable();
            $table->dateTime('subject_committee_accepted_date')->nullable();
            $table->dateTime('council_accepted_date')->nullable();
            $table->string('exam_committee_minute')->nullable();
            $table->string('council_minute')->nullable();
            $table->tinyInteger('re_exam')->nullable();
            $table->string('re_exam_attempts')->nullable();
            $table->tinyInteger('re_exam_voucher_accept')->nullable();
            $table->string('re_exam_voucher_image')->nullable();
            $table->tinyInteger('voucher_uploaded')->nullable();

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
        Schema::dropIfExists('registration_processing');
    }
}
