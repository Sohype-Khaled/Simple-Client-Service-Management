<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded = [];

    public function scopeIndex($query)
    {
        return $query->select('id','title','status','phone','contract_start_date','contract_end_date')->get();
    }

    public function scopeWithServices($query)
    {
        return $query->with(['Services']);
    }

    public function Services()
    {
        return $this->hasMany('App\Models\Service','user_id','id');
    }

    public function ServiceType()
    {
        return $this->belongsToMany('App\Models\ServiceType','services','user_id','type_id')->withTimestamps();
    }
}
