<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    protected $guarded = [];

    public function Services()
    {
        return $this->hasMany('App\Models\Service','type_id','id');
    }

    public function Client()
    {
        return $this->belongsToMany('App\Models\Clients','services','type_id','user_id')->withTimestamps();
    }
}
