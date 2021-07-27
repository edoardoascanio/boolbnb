<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Sponsorship extends Model
{
    protected $fillable = [

        'title', 'end_date', 'price', 'duration', 'accomodation_id'
    ];


    public function accomodation() {
        return $this->belongsTo("App\Accomodation");
    }

    
}
