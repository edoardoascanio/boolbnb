<?php

namespace App\Http\Controllers\Message;

use App\Accomodation;
use App\Http\Controllers\Controller;
use App\Mail\AccomodationMail;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    public function create($id)
    {
        $accomodation = Accomodation::findOrFail($id);

        return view('message.create', compact('accomodation'));
    }

    public function store(Request $request, $id)
    {

        $request->validate([
            'object_email' => 'required|string|min:1|max:255',
            'content' => 'required|string|min:5|max:1000',
            'email_sender' => 'required|string|max:255',
        ]);

        $message = new Message();

        $data = $request->all();

        $message->fill($data);

        $message->accomodation_id = $id;

        $message->save();
        $accomodation = Accomodation::findOrFail($id);
        $owner = User::findOrFail($accomodation->user_id);

        Mail::to($owner->email)->send(new AccomodationMail($message));

        return redirect()->route('guest.show', $id);
    }

    public function index($id)
    {
        $messages = Message::where('accomodation_id', $id)->get();
        $accomodation = Accomodation::findOrFail($id);
        if (isset(Auth::user()->id) && Auth::user()->id == $accomodation->user_id) {

            return view('message.index', ['messages' => $messages]);
        }
        abort(403, 'Unauthorized action.');
    }

    public function show($id)
    {
        $message = Message::findOrFail($id);
        $accomodation = Accomodation::findOrFail($message->accomodation_id);
        if (isset(Auth::user()->id) && Auth::user()->id == $accomodation->user_id) {

            return view('message.show', compact('message'));
        }
        abort(403, 'Unauthorized action.');
    }
}
