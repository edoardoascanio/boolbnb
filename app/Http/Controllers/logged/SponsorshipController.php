<?php

namespace App\Http\Controllers\Logged;

use App\Accomodation;
use App\Http\Controllers\Controller;
use App\Sponsorship;
use App\User;
use Illuminate\Http\Request;

class SponsorshipController extends Controller
{
    public function payment($id) {
        $sponsorships = Sponsorship::all();

        return view('logged.sponsorship.payment', ['id' => $id, 'sponsorships' => $sponsorships]);
    }

    public function store(Request $request, $id)
    {
        $accomodation = Accomodation::findOrFail($id);
        // $user = User::where('accomodation_id', $id);
        
        $data = $request->all();
        $accomodation->update($data);

        if (isset($data['sponsorship'])) {
            

            $accomodation->sponsorship()->attach($data['sponsorship']);
        }

        return redirect()->route('logged.show', $id);

    }
}
