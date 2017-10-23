<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = "User";
    public $timestamps = false;
    public function getUser()
    {
    	return $this->belongsToMany("App\User");
    }
}