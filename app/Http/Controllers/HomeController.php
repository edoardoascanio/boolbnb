<?php

namespace App\Http\Controllers;

use App\Accomodation;
use App\Sponsorship;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function home () {
        $accomodations = Accomodation::all();
        $now = date("Y-m-d H:i:s");
        $accomodation_sponsored = [];

        foreach ($accomodations as $accomodation) {
            $accomodation->link = route("guest.show", ["id" => $accomodation->id]);
            $accomodation->placeholder = $accomodation->placeholder ? asset('storage/' . $accomodation->placeholder) : asset('placeholder/house-placeholder.jpeg');
            $sponsor = Sponsorship::where('accomodation_id', $accomodation->id)->where('end_date', '>', $now)->get();
            if (count($sponsor) > 0 && count($accomodation_sponsored) <= 3) {
                $accomodation_sponsored[] = $accomodation;
            }
        }

        return view('guest.home', ['accomodations' => $accomodation_sponsored]);
    }
}
