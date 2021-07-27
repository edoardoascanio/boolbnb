<?php

namespace App\Http\Controllers\Logged;

use App\Accomodation;
use App\Http\Controllers\Controller;
use App\Sponsorship;
use App\User;
use DateTime;
use Illuminate\Http\Request;

class SponsorshipController extends Controller
{
    public function create($id) {

        return view('logged.sponsorship.create', ['id' => $id]);
    }

    public function store(Request $request, $id)
    {
        $new_sponsorship = new Sponsorship();

        $request->validate([
            'option' => 'required|string|min:4|max:6'
        ]);

        $data = $request->all();
        $now = new DateTime(now());
        $verify = null;
        $sponsor = [];

        if($data['option'] === 'bronze') {
            $verify = true;
            $sponsor = [
                'title' => 'bronze',
                'price' => 2.99,
                'duration' => 24,
                'end_date' => $now->modify('+1 day'),
                'accomodation_id' => $id,
            ];
        }
        if($data['option'] === 'silver') {
            $verify = true;
            $sponsor = [
                'title' => 'bronze',
                'price' => 4.99,
                'duration' => 72,
                'end_date' => $now->modify('+3 day'),
                'accomodation_id' => $id,
            ];
        }
        if($data['option'] === 'gold') {
            $verify = true;
            $sponsor = [
                'title' => 'gold',
                'price' => 9.99,
                'duration' => 144,
                'end_date' => $now->modify('+6 day'),
                'accomodation_id' => $id,
            ];
        }

        if($verify) {

            $new_sponsorship->fill($sponsor);
            $new_sponsorship->accomodation_id = $id;
    
            $new_sponsorship->save();
        }

        return redirect()->route('logged.show', $id);

    }
}
