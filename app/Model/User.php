<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $table="user";
    public $primaryKey="uid";
    public $timestamps=false;
}
