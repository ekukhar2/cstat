<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCstatPageCounter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cstat_counter', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->integer('today')->nullable();
            $table->integer('tomorrow')->nullable();
            $table->integer('alld')->nullable();
            $table->string('todaydate')->nullable();
            $table->timestamps();
        });
        Schema::create('cstat_visitors', function (Blueprint $table) {
            $table->integer('id')->unique();
            $table->string('remote',15)->nullable();
            $table->text('self')->nullable();
            $table->string('country',50)->nullable();
            $table->string('countrycode',10)->nullable();
            $table->timestamps();
        });
        Schema::create('cstat_insite', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->string('remote',15)->nullable();
            $table->text('self')->nullable();
            $table->integer('times')->nullable();
            $table->string('username',50)->nullable();
            $table->string('country',50)->nullable();
            $table->string('countrycode',10)->nullable();
            $table->timestamps();
        });
        Schema::create('cstat_counteralldays', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->integer('unidays')->nullable();
            $table->integer('alldays')->nullable();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cstat_counter');
        Schema::dropIfExists('cstat_visitors');
        Schema::dropIfExists('cstat_insite');
        Schema::dropIfExists('cstat_counteralldays');
    }
}
