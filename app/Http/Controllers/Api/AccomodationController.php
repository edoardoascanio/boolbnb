<?php

namespace App\Http\Controllers\Api;

use App\Accomodation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

class AccomodationController extends Controller
{
    public function index(Request $request)
    {
        $accomodations = Accomodation::with('services')->with('sponsorships')->with('views')->where('visibility', 1)->paginate(10);

        foreach ($accomodations as $accomodation) {
            
            $accomodation->link = route("guest.show", ["id" => $accomodation->id]);
            $accomodation->placeholder = $accomodation->placeholder ? asset('storage/' . $accomodation->placeholder) : asset('placeholder/house-placeholder.jpeg');
        }

        return response()->json([
            'success' => true,
            'results' => $accomodations,
        ]);
    }

    public function filtered(Request $request)
    {
        DB::enableQueryLog();
        $filters = $request->only(["number_beds", "number_rooms", "city", "services"]);

        if (count($filters) == 0) {
            $accomodations = Accomodation::with('services')->with('sponsorships')->with('views')->where('visibility', 1)->paginate(10);

            foreach ($accomodations as $accomodation) {
                $accomodation->link = route("guest.show", ["id" => $accomodation->id]);
                $accomodation->placeholder = $accomodation->placeholder ? asset('storage/' . $accomodation->placeholder) : asset('placeholder/house-placeholder.jpeg');
            }

            return response()->json([
                'success' => true,
                'filters' => $filters,
                'results' => $accomodations,
            ]);
        }

        $query  = explode('&', $_SERVER['QUERY_STRING']);
        $accomodations = Accomodation::select('accomodations.*')->with('services')->where('visibility', 1);
        $params = [];

        foreach ($query as $param) {
            list($name, $value) = explode('=', $param, 2);
            $params[urldecode($name)][] = urldecode($value);
        }

        foreach ($filters as $filter => $value) {
            if ($filter === 'number_beds') {

                if (!is_array($value)) {
                    $value = explode(",", $value);
                }
                $accomodations->where('number_beds', '>=', $value);

            } else if ($filter === 'number_rooms') {

                if (!is_array($value)) {
                    $value = explode(",", $value);
                }
                $accomodations->where('number_rooms', '>=', $value);

            } else if ($filter === "services") {

                if (!is_array($value)) {
                    $value = explode(",", $value);
                }        
                $accomodations->leftJoin("accomodation_service", "accomodations.id", "=", "accomodation_service.accomodation_id")
                                 ->whereIn("accomodation_service.service_id", $value)
                                 ->groupBy('accomodations.id')
                                ->havingRaw("COUNT(DISTINCT `accomodation_service`.`service_id`) = ".count($value));               
            } else {

                $accomodations->where($filter, "LIKE", "%$value%");
            }
             
        }
    
        $filtered_accomodations = $accomodations->get();
        $quries = DB::getQueryLog();
        // dd($quries);

        foreach ($filtered_accomodations as $accomodation) {
            $accomodation->link = route("guest.show", ["id" => $accomodation->id]);
            $accomodation->placeholder = $accomodation->placeholder ? asset('storage/' . $accomodation->placeholder) : asset('placeholder/house-placeholder.jpeg');

        }
        return response()->json([
            'success' => true,
            'params' => $params,
            'results' => $filtered_accomodations,
        ]);
    }
}