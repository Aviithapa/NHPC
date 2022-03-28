<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrantQualificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrant_qualification', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('board_university')->nullable();
            $table->date('passed_year')->nullable();
            $table->date('admission_year')->nullable();
            $table->integer('program_id')->nullable();
            $table->integer('collage_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('level')->nullable();
            $table->bigInteger('registration_number')->nullable();
            $table->string('transcript_image')->nullable();
            $table->string('provisional_image')->nullable();
            $table->string('character_image')->nullable();
            $table->string('migration_image')->nullable();
            $table->string('ojt_image')->nullable();
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
        Schema::dropIfExists('registrant_qualification');
    }
}
