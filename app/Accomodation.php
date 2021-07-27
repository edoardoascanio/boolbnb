<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accomodation extends Model
{
    protected $fillable = [
        'title', 'description', 'number_rooms', 'number_bathrooms',
        'number_beds', 'square_mts', 'visibility', 'country',
        'price_per_night', 'city', 'street_name', 'building_number',
        'type_street', 'lat', 'lon', 'placeholder', 'user_id', 'zip',
        'province', 'check_in', 'check_out',
    ];

    public function user() {
        return $this->belongsTo("App\User");
    }

    public function images() {
        return $this->hasMany('App\Images');
    }

    public function services() {
        return $this->belongsToMany('App\Service');
    }

    public function messages() {
        return $this->hasMany('App\Message');
    }

    public function views() {
        return $this->hasMany('App\View');
    }

    public function sponsorships() {
        return $this->hasMany('App\Sponsorship');
    }
}
