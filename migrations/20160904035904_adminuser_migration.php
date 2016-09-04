<?php

use Joyrun\Migration\Migration;

class AdminuserMigration extends Migration
{
    public function up()
    {
        $this->schema->create('adminusers', function(Illuminate\Database\Schema\Blueprint $table){
            // Auto-increment id
            $table->increments('id');

            $table->string('username');
            $table->string('email');
            $table->string('password');
            $table->string('role');
            $table->tinyInteger('status');

            // Required for Eloquent's created_at and updated_at columns
            $table->timestamps();
        });
    }

    public function down()
    {
        $this->schema->drop('adminusers');
    }
}
