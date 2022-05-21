<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title')->index()->nullable();
            $table->date('start_date')->index()->nullable();
            $table->date('end_date')->index()->nullable();
            $table->integer('repeat')->index()->nullable();
            $table->string('repeat_type')->nullable();
            $table->string('repeat_day')->nullable();
            $table->string('repeat_day_type')->nullable();
            $table->string('repeat_type_days')->nullable();
            $table->string('repeat_type_monthly')->nullable();
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
        Schema::dropIfExists('events');
    }
}
