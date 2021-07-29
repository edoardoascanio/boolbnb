<?php

namespace App\Http\Controllers;

use App\Accomodation;
use App\Mail\SponsorshipMail;
use App\Sponsorship;
use App\User;
use Illuminate\Http\Request;
use Braintree\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PaymentsController extends Controller
{

    public function make(Request $request)
    {
        $sponsorTypeName = $request->input('value');

        if($sponsorTypeName === 'bronze') {
            $verify = true;
            $sponsor = [
                'title' => 'bronze',
                'price' => 2.99,
                'duration' => 24,
            ];
        }
        if($sponsorTypeName === 'silver') {
            $verify = true;
            $sponsor = [
                'title' => 'bronze',
                'price' => 4.99,
                'duration' => 72,
            ];
        }
        if($sponsorTypeName === 'gold') {
            $verify = true;
            $sponsor = [
                'title' => 'gold',
                'price' => 9.99,
                'duration' => 144,
            ];
        }

        $payload = $request->input('payload', false);
        $nonce = $payload['nonce'];
        $status = Transaction::sale([
            'amount' => $sponsor['price'],
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => True
            ]
        ]);

        if($status->success){
            $sponsorship = new Sponsorship();
            $sponsorship->accomodation_id =  $request->input('flat');
            $sponsorship->title = $sponsor['title'];
            $sponsorship->duration = $sponsor['duration'];
            $sponsorship->price = $sponsor['price'];
            $sponsorship->end_date = date("Y-m-d H:i:s", strtotime(sprintf("+%d hours", $sponsorship->duration)));
            $sponsorship->save();

            // $user = Auth::user()->id;
            // $accomodation = Accomodation::findOrFail($request->input('flat'));

            // $argument = [
            //     'accomodation' => $accomodation,
            //     'sponsorship' => $sponsorship,
            // ];

            // Mail::to($user->email)->send(new SponsorshipMail($argument));

            return response()->json($status);
        }else{
            return response()->json($status);
        }
    }
}