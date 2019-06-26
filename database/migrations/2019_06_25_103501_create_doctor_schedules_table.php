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
            $table->string('daynumber');
            $table->string('dayname_ar');
            $table->string('dayname_en');
            $table->string('shift_flag');
            $table->string('starttime');
            $table->string('endtime');
            $table->string('duration_by_hour');
            $table->string('time_slot_by_minute');
            $table->string('startdate');
            $table->string('enddate');
            $table->string('week_frequency_flag');
            $table->string('emp_id');
            $table->string('place_id1');
            $table->string('hosp_id');
            $table->string('serial');
            $table->string('queue_system_integ_flag');
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
