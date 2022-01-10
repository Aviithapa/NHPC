<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('first_name_nep')->nullable();
            $table->string('middle_name_nep')->nullable();
            $table->string('last_name_nep')->nullable();
            $table->date('dob_eng')->nullable();
            $table->date('dob_nep')->nullable();
            $table->enum('sex', ['male','female','other'])->nullable()->default('male');
            $table->enum('marital_status', ['married', 'unmarried'])->nullable()->default('unmarried');
            $table->string('ethinic')->nullable();
            $table->string('cast')->nullable();
            $table->string('citizenship_number')->nullable();
            $table->date('citizenship_issue_date')->nullable();
            $table->string('issue_district')->nullable();
            $table->string('father_name')->nullable();
            $table->string('father_name_nep')->nullable();
            $table->string('grandfather_name')->nullable();
            $table->string('grandfather_name_nep')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_name_nep')->nullable();
            $table->string('development_region')->nullable();
            $table->string('zone')->nullable();
            $table->string('district')->nullable();
            $table->string('vdc_municiplality')->nullable() ;
            $table->string('ward_no')->nullable();
            $table->date('admission_year')->nullable();
            $table->string('collage_name')->nullable();
            $table->string('program_name')->nullable();
            $table->string('registration_number')->nullable();
            $table->string('hospital_name')->nullable();
            $table->string('husband_wife_name')->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('citizenship_front')->nullable();
            $table->string('citizenship_back')->nullable();
            $table->string('signature_image')->nullable();
            $table->string('ojt_image')->nullable();
            $table->enum('is_registrated', ['yes', 'no'])->nullable()->default('yes');
            $table->string('counil_name')->nullable();
            $table->string('registration_date')->nullable();
            $table->string('hospital_registration_number')->nullable();
            $table->string('registration_subject')->nullable();
            $table->string('registration_level')->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
