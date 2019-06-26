<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid');
            $table->integer('desk_queue_id')->nullable();

            $table->integer('doctor_id'); // doctor_id
            $table->integer('clinic_id'); // clinic_id
            $table->string('source_reservation_serial'); // ser
            $table->string('source_reservation_patient_pin'); // que_sys_ser
            $table->string('source_queue_number'); // que_sys_ser

            $table->string('patientid')->nullable();
            $table->timestamp('reservation_date_time')->nullable();
            $table->string('speciality_id')->nullable();
            $table->string('servstatus')->nullable();
            $table->string('cashier_flag')->nullable();

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
        Schema::dropIfExists('reservations');
    }
}
