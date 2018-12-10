<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('meetup_id');
            $table->string('venue_name');
            $table->timestamp('date');
            $table->longText('intro')->nullable();

            $table->longText('speaker_1_name')->nullable();
            $table->longText('speaker_1_abstract')->nullable();
            $table->longText('speaker_2_name')->nullable();
            $table->longText('speaker_2_abstract')->nullable();

            $table->longText('tweet')->nullable();
            $table->timestamp('tweet_sent_at')->nullable();
            $table->timestamps();
        });
    }
}
