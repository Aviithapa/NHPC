<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provinces', function (Blueprint $table) {
            $table->id();
            $table->string('province_name');
            $table->string('capital')->nullable();
            $table->bigInteger('no_of_districts')->nullable();
            $table->bigInteger('area')->nullable()->default(12);
            $table->string('image')->nullable();
            $table->timestamps();
        });

        Schema::create('districts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('province_id');
            $table->string('name')->index();
            $table->string('headquater');
            $table->bigInteger('area')->nullable()->default(12);
            $table->foreign('province_id')->references('id')->on('provinces');
            $table->timestamps();
        });

        Schema::create('municipalities', function (Blueprint $table) {
            $table->id();
            $table->string('district_name')->index();
            $table->string('name')->unique();
            $table->string('link');
            $table->foreign('district_name')->references('name')->on('districts')->onDelete('cascade');
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
        Schema::dropIfExists('municipalities');
        Schema::dropIfExists('districts');
        Schema::dropIfExists('provinces');
    }
}
