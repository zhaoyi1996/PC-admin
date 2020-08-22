<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $table="news_links";
    protected $primaryKey = "l_id";
    public $timestamps = false;
    protected $fillable = ['l_id','l_name','l_url'];
}
