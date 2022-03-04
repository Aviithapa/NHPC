<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->increments('id')->default(1);
            $table->string('name')->nullable()->default('');
            $table->string('image')->nullable()->default('');
            $table->string('link')->nullable()->default('');
            $table->string('title')->nullable()->default('');
            $table->string('status')->nullable()->default('draft');
            $table->string('type')->nullable()->default('image');
            $table->softDeletes();
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
        Schema::dropIfExists('sliders');
    }
}
