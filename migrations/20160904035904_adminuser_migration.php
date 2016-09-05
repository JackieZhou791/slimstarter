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
        
        $initUsers = [
            [
                'username'  => 'admin',
                'email'     => 'zhoujieweb@thejoyrun.com',
                'password'  => password_hash('password', PASSWORD_DEFAULT),
                'role'      => 'admin',
                'status'    => 1
            ]
        ];
        $this->table('adminusers')->insert($initUsers)->save();
    }

    public function down()
    {
        $this->schema->drop('adminusers');
    }
}
