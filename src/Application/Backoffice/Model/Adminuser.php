<?php

namespace Application\Backoffice\Model;

use Illuminate\Database\Eloquent\Model;

class Adminuser extends Model
{

    protected $table = 'adminusers';

    protected $fillable = ['id', 'username', 'password', 'email', 'role', 'status'];
}