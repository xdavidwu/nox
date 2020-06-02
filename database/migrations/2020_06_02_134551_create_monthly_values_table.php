<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthlyValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('station_id')->constrained();
            $table->date('month');
            $table->float('so2', 8, 4)->nullable();
            $table->float('co', 8, 4)->nullable();
            $table->float('co2', 8, 4)->nullable();
            $table->float('o3', 8, 4)->nullable();
            $table->float('pm10', 8, 4)->nullable();
            $table->float('pm25', 8, 4)->nullable();
            $table->float('nox', 8, 4)->nullable();
            $table->float('no', 8, 4)->nullable();
            $table->float('no2', 8, 4)->nullable();
            $table->float('thc', 8, 4)->nullable();
            $table->float('nmhc', 8, 4)->nullable();
            $table->float('ch4', 8, 4)->nullable();
            $table->float('wind_speed', 8, 4)->nullable();
            $table->float('ws_hr', 8, 4)->nullable();
            $table->float('amb_temp', 8, 4)->nullable();
            $table->float('rain_int', 8, 4)->nullable();
            $table->float('ph_rain', 8, 4)->nullable();
            $table->float('rh', 8, 4)->nullable();
            $table->float('rain_cond', 8, 4)->nullable();
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
        Schema::dropIfExists('monthly_values');
    }
}
