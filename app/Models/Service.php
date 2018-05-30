<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $guarded = [];

    public $appends = ['title','client','type'];

    protected $hidden = ['type_id','user_id','link','description'];

    public function getTitleAttribute()
    {
        return $this->attributes['title'] = $this->ServiceType()->first()->title;
    }

    public function getTypeAttribute()
    {
        return $this->attributes['type'] = $this->ServiceType()->first()->title;
    }

    public function getClientAttribute()
    {
        return $this->attributes['client'] = $this->Client()->first()->title;
    }

    public function ServiceType()
    {
        return $this->belongsTo('App\Models\ServiceType','type_id','id');
    }

    public function Client()
    {
        return $this->belongsTo('App\Models\Client','user_id','id');
    }
}
