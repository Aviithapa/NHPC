<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationProcessDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registration_process_details', function (Blueprint $table) {
            $table->id();
            $table->integer('registration_processing_id')->nullable();
            $table->integer('registration_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('created_by')->nullable();
            $table->enum('state_', ['computer_operator','registrar','subject_committee','exam_committee','officer','onhold','council'])->nullable();
            $table->enum('status_', ['pending','progress','accepted','rejected'])->nullable();
            $table->string('remarks')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('review_status')->nullable();
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
        Schema::dropIfExists('registration_process_details');
    }
}
