<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('active')->nullable();
            $table->string('code')->nullable();
            $table->string('tradeName')->nullable();
            $table->string('paking')->nullable();
            $table->string('focus')->nullable();
            $table->string('pPrice')->nullable();
            $table->string('ppPrice')->nullable();
            $table->string('drugStore')->nullable();
            $table->string('companyName')->nullable();
            $table->integer('user_id');
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
        Schema::dropIfExists('loads');
    }
}
