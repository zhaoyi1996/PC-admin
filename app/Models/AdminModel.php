<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminModel extends Model
{
    //
    public $table = 'rbac_admin';

    public $timestamps = false;

    public $primaryKey = 'admin_id';
}
