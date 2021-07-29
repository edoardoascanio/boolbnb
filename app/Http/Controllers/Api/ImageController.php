<?php

namespace App\Http\Controllers\Api;

use App\Accomodation;
use App\Http\Controllers\Controller;
use App\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    
    public function index ($id) {
        $results = []; 
        $accomodation = Accomodation::find($id);
        
        if($accomodation->placeholder) {
            // $placeholder = $accomodation->placeholder;
            $url_img = asset('storage/' . $accomodation->placeholder);
            $results[] = $url_img;

        }  

        $images = Image::where('accomodation_id', $id)->get();

        if(count($images)  > 0 )  {
            foreach($images as $image) {
                $url_img = asset('storage/' . $image->url_img);
                $results[] = $url_img;
            }
        }

        if(count($results) == 0) {
            $image = asset('placeholder/house-placeholder.jpeg');
            $results[] = $image;
        }

        return response()->json([
            'success' => true,
            'results' => $results,
        ]);
    }
}