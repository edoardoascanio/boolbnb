<?php

namespace App\Http\Controllers\logged;

use App\Accomodation;
use App\Http\Controllers\Controller;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function create($id)
    {
        return view('logged.accomodation.image', ['id' => $id]);
    }

    public function store(Request $request, $id)
    {
        // $accomodation = Accomodation::findOrFail($id);
        $data = $request->all();

        if (count($data) > 0) {
            $image = new Image();
            $image->fill($data);
            $image->accomodation_id = $id;
            $image->url_img = Storage::put('cover_url', $data['cover_url']);
            $image->save();
        }

        return redirect()->route('logged.show', ['id' => $id]);
    }
}
