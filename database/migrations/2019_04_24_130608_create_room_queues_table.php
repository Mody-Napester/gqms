<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomQueuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_queues', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid');
            $table->integer('floor_id');
            $table->integer('room_id')->nullable();
            $table->string('queue_number');
            $table->integer('status'); // 1 Waiting, 2 Call, 3 Patient in,4 Skip, 5 Patient out ,6 Call from skip
            $table->integer('call_count')->unsigned()->default(0);
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
        Schema::dropIfExists('room_queues');
    }
}
