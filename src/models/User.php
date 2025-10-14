<?php

namespace Models;

use Database\Model;

class User extends Model{
    protected static string $table = "users";
    protected static array $fillable = ['email','name','role', 'password'];

}
