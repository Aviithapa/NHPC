<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDocumentsImagesToTheRegistrantQualification extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registrant_qualification', function (Blueprint $table) {
            $table->string('transcript_image')->nullable();
            $table->string('provisional_image')->nullable();
            $table->string('character_image')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('registrant_qualification', function (Blueprint $table) {
            //
        });
    }
}
