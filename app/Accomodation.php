<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accomodation extends Model
{
    protected $fillable = [

        'title', 'description', 'number_rooms', 'number_bathrooms', 
        'number_beds', 'square_mts', 'visibility', 'country',
        'price_per_night', 'city', 'street_name', 'buildingNumber',
        'lat', 'long', 'placeholder'
    ];
    public function user() {
        return $this->belongsTo("App\User");
    }
}