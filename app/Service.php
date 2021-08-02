<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title', 'description', 'icon'
    ];

    public function accomodations () {
        return $this->belongsToMany('App\Accomodation');
    }
}
