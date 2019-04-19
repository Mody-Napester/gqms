<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeskQueuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('desk_queues', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid');
            $table->integer('floor_id');
            $table->integer('desk_id')->nullable();
            $table->string('queue_number');
            $table->integer('status'); // 1 Waiting, 2 Call, 3 Pass == Skip, 4 Done,5 Call from pass
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
        Schema::dropIfExists('desk_queues');
    }
}
