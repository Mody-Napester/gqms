<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid');
            $table->string('daynumber')->nullable();
            $table->string('dayname_ar')->nullable();
            $table->string('dayname_en')->nullable();
            $table->string('shift_flag')->nullable();
            $table->string('starttime')->nullable();
            $table->string('endtime')->nullable();
            $table->string('duration_by_hour')->nullable();
            $table->string('time_slot_by_minute')->nullable();
            $table->string('startdate')->nullable();
            $table->string('enddate')->nullable();
            $table->string('week_frequency_flag')->nullable();
            $table->string('emp_id')->nullable();
            $table->string('place_id1')->nullable();
            $table->string('hosp_id')->nullable();
            $table->string('serial')->nullable();
            $table->string('queue_system_integ_flag')->nullable();
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
        Schema::dropIfExists('doctor_schedules');
    }
}
