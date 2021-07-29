<?php

namespace App\Http\Controllers\logged;

use App\Accomodation;
use App\Http\Controllers\Controller;
use App\Mail\AccomodationMail;
use App\Mail\newAccomodationMail;
use App\Message;
use App\Service;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Constraint\IsFalse;

class AccomodationController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        $services = Service::all();

        return view('logged.accomodation.create', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:5|max:85',
            'description' => 'required|string|min:5|max:2000',
            'number_rooms' => 'required|integer|min:1|max:20',
            'number_bathrooms' => 'required|integer|min:1|max:20',
            'number_beds' => 'required|integer|min:1|max:20',
            'square_mts' => 'required|integer|min:10|max:1000|',
            'visibility' => 'required|bool',
            'country' => 'required|string|min:3|max:50',
            'city' => 'required|string|min:3|max:50',
            'province' => 'required|string|min:3|max:50',
            'zip' => 'required|string|size:5',
            'street_name' => 'required|string|min:3|max:150',
            'building_number' => 'required|string|min:1|max:10000',
            'placeholder' =>  'mimes:jpeg,jpg,bmp,png,svg,webp,gif',
            'price_per_night' => 'required|integer|min:10|max:500',
            'check_in' => 'required|integer|min:0|max:23',
            'check_out' => 'required|integer|min:0|max:23'
        ]);

        $data = $request->all();
        $address = $request->province . '%20' . $request->city . '%20' . $request->type_street . '%20' . $request->street_name . '%20' . $request->building_number;
        $response = Http::withOptions(['verify' => false])->get('https://api.tomtom.com/search/2/geocode/' . $address . '.json?Key=t4QufcKAvdkiBeKqaOB5kwMYk71Rx8b6')->json();
        $lat = $response['results'][0]['position']['lat'];
        $lon = $response['results'][0]['position']['lon'];

        $new_accomodation = new Accomodation();

        $new_accomodation->fill($data);

        if (isset($data['placeholder'])) {
            $new_accomodation->placeholder = Storage::put('placeholder', $data['placeholder']);
        }

        $new_accomodation->user_id = $request->user()->id;
        $new_accomodation->lat = $lat;
        $new_accomodation->lon = $lon;

        $new_accomodation->save();
        
        if (isset($data['services'])) {
            $new_accomodation->services()->sync($data['services']);
            $new_accomodation->count_services = count($data['services']);
        }
        
        // if($new_accomodation->visibility) {
        //     $user = User::findOrFail($request->user()->id);
        //     Mail::to($new_accomodation->user_id->email)->send(new newAccomodationMail($new_accomodation));
        // }

        return redirect()->route('logged.show', $new_accomodation->id);
    }

    public function show($id)
    {
        $accomodation = Accomodation::findOrFail($id);
        if (Auth::user()->id == $accomodation->user_id) {

            $messages = Message::where('accomodation_id', $id)->get();

            return view('logged.accomodation.show', ['accomodation' => $accomodation, 'messages' => $messages]);
        }
        return view('guest.home');
    }

    public function edit($id)
    {
        $accomodation = Accomodation::findOrFail($id);

        if (Auth::user()->id == $accomodation->user_id) {

            $services = Service::all();

            return view('logged.accomodation.edit', ['accomodation' => $accomodation, 'services' => $services]);
        }

        return view('guest.home');
    }

    public function update(Request $request, $id)
    {
        $accomodation = Accomodation::findOrFail($id);

        if (Auth::user()->id == $accomodation->user_id) {

            $request->validate([
                'title' => 'required|string|min:5|max:85',
                'description' => 'required|string|min:5|max:2000',
                'number_rooms' => 'required|integer|min:1|max:20',
                'number_bathrooms' => 'required|integer|min:1|max:20',
                'number_beds' => 'required|integer|min:1|max:20',
                'square_mts' => 'required|integer|min:10|max:1000|',
                'visibility' => 'nullable|bool',
                'country' => 'required|string|min:3|max:50',
                'city' => 'required|string|min:3|max:50',
                'province' => 'required|string|min:3|max:50',
                'zip' => 'required|string|size:5',
                'street_name' => 'required|string|min:3|max:150',
                'building_number' => 'required|string|min:1|max:10000',
                // 'placeholder' => 'nullable|string|min:1|max:200',
                'price_per_night' => 'required|integer|min:10|max:500',
                'check_in' => 'required|integer|min:0|max:23',
                'check_out' => 'required|integer|min:0|max:23'
            ]);

            $data = $request->all();

            $address = $request->province . '%20' . $request->city . '%20' . $request->type_street . '%20' . $request->street_name . '%20' . $request->building_number;
            $response = Http::withOptions(['verify' => false])->get('https://api.tomtom.com/search/2/geocode/' . $address . '.json?Key=t4QufcKAvdkiBeKqaOB5kwMYk71Rx8b6')->json();
            $lat = $response['results'][0]['position']['lat'];
            $lon = $response['results'][0]['position']['lon'];

            $accomodation->lat = $lat;
            $accomodation->lon = $lon;

            if (key_exists("placeholder", $data)) {
                if ($accomodation->placeholder) {
                    Storage::delete($accomodation->placeholder);
                }
                $placeholder = Storage::put("placeholder", $data["placeholder"]);

                $data["placeholder"] = $placeholder;
            }
            $accomodation->update($data);

            if (isset($data['services'])) {
                $accomodation->count_services = count($data['services']);

                $accomodation->services()->sync($data['services']);
            }

            return redirect()->route('logged.show', $id);
        }

        return view('guest.home');
    }

    public function destroy($id)
    {
        $accomodation = Accomodation::findOrFail($id);

        if (Auth::user()->id == $accomodation->user_id) {

            $user_id = $accomodation->user_id;

            $accomodation->services()->detach();

            $accomodation->messages()->delete();

            $accomodation->views()->delete();

            // $accomodation->images()->delete();
            // $accomodation->sponsorhip()->detach();

            $accomodation->delete();

            return redirect()->route('logged.dashboard', $user_id);
        }

        return view('guest.home');
    }

    public function visibility(Request $request, $id)
    {
        $accomodation = Accomodation::findOrFail($id);
        if (Auth::user()->id == $accomodation->user_id) {

            $data = $request->all();

            $accomodation->update($data);

            return redirect()->back();
        }
        return view('guest.home');
    }

    public function statviews($id) {

        return view('logged.accomodation.statviews', ['id' => $id]);
    }
    public function statmsg($id) {

        return view('logged.accomodation.statmsg', ['id' => $id]);
    }
}
