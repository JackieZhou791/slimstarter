<?php

use Joyrun\Migration\Migration;

class EventMigration extends Migration
{
    public function up()
    {
        $this->schema->create('events', function(Illuminate\Database\Schema\Blueprint $table){
            // Auto-increment id
            $table->increments('id');

            $table->string('title');
            $table->string('description');
            $table->string('relative_url');
            $table->string('start_date');
            $table->string('end_date');
            $table->tinyInteger('status');

            // Required for Eloquent's created_at and updated_at columns
            $table->timestamps();
        });
    }

    public function down()
    {
        $this->schema->drop('events');
    }
}
