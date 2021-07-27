<?php

namespace App\Http\Controllers\Api;

use App\Accomodation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class AccomodationController extends Controller
{
    public function index(Request $request)
    {
        $accomodations = Accomodation::with('services')->with('sponsorship')->with('views')->where('visibility', 1)->paginate(10);

        foreach ($accomodations as $accomodation) {
            $accomodation->link = route("guest.show", ["id" => $accomodation->id]);
            $accomodation->placeholder = $accomodation->placeholder ? asset('storage/' . $accomodation->placeholder) : asset('placeholder/house-placeholder.jpeg');
        }

        return response()->json([
            'success' => true,
            'results' => $accomodations,
        ]);
    }

    // ROOMS AND BEDS
    // public function filtered(Request $request)
    // {
    //         $filters = $request->only(["number_beds", "number_rooms", "city", "services"]);

    //         if (count($filters) == 0) {
    //             $accomodations = Accomodation::with('services')->with('sponsorship')->with('views')->where('visibility', 1)->paginate(10);

    //             foreach ($accomodations as $accomodation) {
    //                 $accomodation->link = route("guest.show", ["id" => $accomodation->id]);
    //                 $accomodation->placeholder = $accomodation->placeholder ? asset('storage/' . $accomodation->placeholder) : asset('placeholder/house-placeholder.jpeg');
    //             }

    //             return response()->json([
    //                 'success' => true,
    //                 'filters' => $filters,
    //                 'results' => $accomodations,
    //             ]);
    //         }

    //         $query  = explode('&', $_SERVER['QUERY_STRING']);
    //         $accomodations = Accomodation::with('services')->where('visibility', 1);
    //         $params = [];

    //         foreach ($query as $param) {
    //             list($name, $value) = explode('=', $param, 2);
    //             $params[urldecode($name)][] = urldecode($value);
    //         }

    //         foreach ($filters as $filter => $value) {
    //             if ($filter === 'number_beds') {

    //                 if (!is_array($value)) {
    //                     $value = explode(",", $value);
    //                 }
    //                 $accomodations->where('number_beds', '>=', $value);

    //             } else if ($filter === 'number_rooms') {

    //                 if (!is_array($value)) {
    //                     $value = explode(",", $value);
    //                 }
    //                 $accomodations->where('number_rooms', '>=', $value);

    //             } else if ($filter === "services") {

    //                 if (!is_array($value)) {
    //                     $value = explode(",", $value);
    //                 }        
    //                 $accomodations->join("accomodation_service", "accomodations.id", "=", "accomodation_service.accomodation_id")
    //                 ->whereIn("accomodation_service.service_id", $value);

    //             } else {

    //                 $accomodations->where($filter, "LIKE", "%$value%");
    //             }

    //         }

    //         $filtered_accomodations = $accomodations->get();

    //         foreach ($filtered_accomodations as $accomodation) {
    //             $accomodation->link = route("guest.show", ["id" => $accomodation->id]);
    //             $accomodation->placeholder = $accomodation->placeholder ? asset('storage/' . $accomodation->placeholder) : asset('placeholder/house-placeholder.jpeg');

    //         }
    //         return response()->json([
    //             'success' => true,
    //             'params' => $params,
    //             'results' => $filtered_accomodations,
    //         ]);
    //     }
    // }
    // in caso di piu filtri ne ritorna solamente 2
    public function filtered(Request $request)
    {
        $filters = $request->only(["number_beds", "number_rooms", "city", "services"]);

        if (count($filters) == 0) {
            $accomodations = Accomodation::with('services')->with('sponsorship')->with('views')->where('visibility', 1)->paginate(10);

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
        $accomodations = Accomodation::with('services')->where('visibility', 1);
        $params = [];
        $prova = [];

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

                $accomodations->where('count_services', '>=', count($params['services']));
                // foreach ($params['services'] as $id) {


                    // $accomodations->whereHas('services', function ($a) use ($id) {
                    //     $a->where('services.id', $id);
                    // });

                // }

            } else {

                $accomodations->where($filter, "LIKE", "%$value%");
            }
        }

        $filtered_accomodations = $accomodations->get();

        foreach ($filtered_accomodations as $accomodation) {
            $accomodation->link = route("guest.show", ["id" => $accomodation->id]);
            $accomodation->placeholder = $accomodation->placeholder ? asset('storage/' . $accomodation->placeholder) : asset('placeholder/house-placeholder.jpeg');
        }
        return response()->json([
            'success' => true,
            'params' => $params,
            'results' => $filtered_accomodations,
            'count_filter' => count($params['services']),
            'prova' => $prova,

        ]);
    }
}

    // youtube
    // public function filtered(Request $request)
    // {
    //     $filters = $request->only(["number_beds", "number_rooms", "city", "services"]);

    //     if (count($filters) == 0) {
    //         $accomodations = Accomodation::with('services')->with('sponsorship')->with('views')->where('visibility', 1)->paginate(10);

    //         foreach ($accomodations as $accomodation) {
    //             $accomodation->link = route("guest.show", ["id" => $accomodation->id]);
    //             $accomodation->placeholder = $accomodation->placeholder ? asset('storage/' . $accomodation->placeholder) : asset('placeholder/house-placeholder.jpeg');
    //         }

    //         return response()->json([
    //             'success' => true,
    //             'filters' => $filters,
    //             'results' => $accomodations,
    //         ]);
    //     }

    //     $query  = explode('&', $_SERVER['QUERY_STRING']);
    //     $accomodations = Accomodation::with('services')->where('visibility', 1)->get();
    //     $params = [];
    //     $services = [];

    //     foreach ($query as $param) {
    //         list($name, $value) = explode('=', $param, 2);
    //         $params[urldecode($name)][] = urldecode($value);
    //     }

    //     foreach ($params as $param => $value) {
    //         if($param == 'services') {
    //             $services[] = $value;
    //         }
    //     }


    //     foreach ($filters as $filter => $value) {
    //         if ($filter === 'number_beds') {

    //             if (!is_array($value)) {
    //                 $value = explode(",", $value);
    //             }
    //             $accomodations->where('number_beds', '>=', $value);

    //         } else if ($filter === 'number_rooms') {

    //             if (!is_array($value)) {
    //                 $value = explode(",", $value);
    //             }
    //             $accomodations->where('number_rooms', '>=', $value);

    //         } else if ($filter === "services") {
    //             // $accomodations->join("accomodation_service", "accomodations.id", "=", "accomodation_service.accomodation_id");
    //             $result = [];
    //             foreach($accomodations as $accomodation) {
    //                 $result[] = '1';
    //                 // foreach($accomodation->service_id as $id => $value){
    //                 //     // if(in_array($value, $services)) {
    //                 //     //     $result[] = '1';
    //                 //     // }
    //                 // }
    //             }


    //         } else {

    //             $accomodations->where($filter, "LIKE", "%$value%");
    //         }

    //     }

    //     $filtered_accomodations = $accomodations->get();

    //     foreach ($result as $accomodation) {
    //         $accomodation->link = route("guest.show", ["id" => $accomodation->id]);
    //         $accomodation->placeholder = $accomodation->placeholder ? asset('storage/' . $accomodation->placeholder) : asset('placeholder/house-placeholder.jpeg');

    //     }
    //     return response()->json([
    //         'success' => true,
    //         'params' => $params,
    //         'services' => $services,
    //         'results' => $result,
    //         'accomodations' => $filtered_accomodations,
    //     ]);
    // }

    // repository
    // public function filtered(Request $request)
    // {
    //     $filters = $request->only(["number_beds", "number_rooms", "city", "services"]);

    //     if (count($filters) == 0) {
    //         $accomodations = Accomodation::with('services')->with('sponsorship')->with('views')->where('visibility', 1)->paginate(10);

    //         foreach ($accomodations as $accomodation) {
    //             $accomodation->link = route("guest.show", ["id" => $accomodation->id]);
    //             $accomodation->placeholder = $accomodation->placeholder ? asset('storage/' . $accomodation->placeholder) : asset('placeholder/house-placeholder.jpeg');
    //         }

    //         return response()->json([
    //             'success' => true,
    //             'filters' => $filters,
    //             'results' => $accomodations,
    //         ]);
    //     }

    //     $number_rooms = isset($filters['number_rooms']) ? $filters['number_rooms'] : 0;
    //     $number_beds = isset($filters['number_beds']) ? $filters['number_beds'] : 0;
    //     $city = isset($filters['city']) ? $filters['city'] : '';
    //     $services = isset($filters['services']) ? array_map('intval', explode(',', $filters['services'])) : [];

    //     $accomodations = Accomodation::where('visibility', '1')
    //         ->where('number_rooms', '>=', $number_rooms)
    //         ->where('number_beds', '>=', $number_beds)
    //         ->where('city', '=', $city)
    //         ->get();

    //     foreach ($accomodations as $key => $accomodation) {
    //         // estraggo tutti gli optionals di ogni appartamento
    //         $serciceAccNome = $accomodation->services()->pluck('title')->toarray();
    //         $serviceAcc = $accomodation->services()->pluck('id')->toarray();
    //         /* array_diff confronta gli elementi del primo array con gli elementi del secondo array e restituisce gli elementi del primo array che non ha trovato nel secondo array.
    //             con l'array degli optionals vuoto ritorna [] perchè non ha elementi da restituire
    //             con il ! davanti se non ci sono differenze ritorna true mentre ritorna false se trova differenze.
    //             */
    //         if (!array_diff($services, $serviceAcc)) {
    //             // se gli optionals corrispondono ai filtri di ricerca li aggiungo all'array degli appartamenti
    //             $accomodation['services'] = $serviceAcc;
                
    //         } else {
    //             // se gli optionals non corrispondono ai filtri di ricerca elimino l'appartamento dall'array
    //             $accomodations->forget($key);
    //         }
    //     }

    //     return response()->json($accomodations);
    // }
