<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileProcessingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_processing', function (Blueprint $table) {
            $table->id();
            $table->integer('profile_id')->nullable();
            $table->enum('current_state', ['computer_operator','registrar','subject_committee','exam_committee','officer','onhold','council'])->nullable();
            $table->enum('status', ['pending','progress','accepted','rejected'])->nullable();
            $table->string('remarks')->nullable();
            $table->integer('subject_committee_accepted_num')->default(0);
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
        Schema::dropIfExists('profile_processing');
    }
}
