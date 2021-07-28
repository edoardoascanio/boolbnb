<?php

namespace App\Http\Controllers\Logged;

use App\Accomodation;
use App\Http\Controllers\Controller;
use App\Sponsorship;
use App\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard($id)
    {
        $accomodations = Accomodation::orderBy("created_at", "DESC")->where('user_id', $id)->get();
        $list = [];
        $now = date("Y-m-d H:i:s");

        foreach ($accomodations as $accomodation) {
            $sponsor = Sponsorship::where('accomodation_id', $accomodation->id)->where('end_date', '>', $now)->orderBy("created_at", "DESC")->limit(1)->get();
            if (count($sponsor) == 0) {

                // $last_sponsorship = Sponsorship::where('accomodation_id', $accomodation->id)->orderBy("created_at", "DESC")->limit(1)->get();
                $accomodation->sponsorActive = false;
                
            } else {
                $accomodation->sponsorActive = true;
            }
            $list[] = $accomodation; 

        }
        return view('logged.user.dashboard', ['accomodations' => $list]);
    }
}
