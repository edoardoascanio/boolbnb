<?php
namespace App\Http\Controllers\Api;
use App\Accomodation;
use App\Http\Controllers\Controller;
use App\Message;
use App\Service;
use App\Sponsorship;
use App\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Console\Input\Input;
class AccomodationController extends Controller
{
    public function index(Request $request)
    {
        $accomodations = Accomodation::with('services')->with('sponsorships')->with('views')->where('visibility', 1)->paginate(2);
        $now = date("Y-m-d H:i:s");
        foreach ($accomodations as $accomodation) {
            $sponsor = Sponsorship::where('accomodation_id', $accomodation->id)->where('end_date', '>', $now)->orderBy("created_at", "DESC")->limit(1)->get();
            $accomodation->link = route("guest.show", ["id" => $accomodation->id]);
            $accomodation->placeholder = $accomodation->placeholder ? asset('storage/' . $accomodation->placeholder) : asset('placeholder/house-placeholder.jpeg');
        }
        // $result = $accomodation->orderBy('sponsorActive');
        return response()->json([
            'success' => true,
            'results' => $accomodations,
        ]);
    }
    public function filtered(Request $request)
    {
        $now = date("Y-m-d H:i:s");
        DB::enableQueryLog();
        $filters = $request->only(["number_beds", "number_rooms", "city", "services", "range"]);
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
                    ->havingRaw("COUNT(DISTINCT `accomodation_service`.`service_id`) = " . count($value));
            } else if ($filter === "city") {
                $accomodations->where($filter, "LIKE", "%$value%");
            }
        }
        $filtered_accomodations = $accomodations->get();
        $quries = DB::getQueryLog();
        // dd($quries);
        $not_sponsor = [];
        $with_sponsor = [];
        foreach ($filtered_accomodations as $accomodation) {
            $accomodation->link = route("guest.show", ["id" => $accomodation->id]);
            $accomodation->placeholder = $accomodation->placeholder ? asset('storage/' . $accomodation->placeholder) : asset('placeholder/house-placeholder.jpeg');
            $sponsor = Sponsorship::where('accomodation_id', $accomodation->id)->where('end_date', '>', $now)->get();
            if (count($sponsor) == 0) {
                $accomodation->active = false;
                $not_sponsor[] = $accomodation;
            } else {
                $accomodation->active = true;
                $with_sponsor[] = $accomodation;
            }
        }
        // foreach($not_sponsor as $single_acc) {
        //     $results[] = $single_acc;
        // }
        $results = array_merge($with_sponsor, $not_sponsor);
            $response = Http::withOptions(['verify' => false])->get('https://api.tomtom.com/search/2/geocode/' . $filters['city'] . '.json?Key=t4QufcKAvdkiBeKqaOB5kwMYk71Rx8b6')->json();
            $position = [
                'lat' => $response['results'][0]['position']['lat'],
                'lon' => $response['results'][0]['position']['lon'],
            ];
            function distance($lat1, $lon1, $lat2, $lon2, $unit) {
                if (($lat1 == $lat2) && ($lon1 == $lon2)) {
                  return 0;
                }
                else {
                  $theta = $lon1 - $lon2;
                  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
                  $dist = acos($dist);
                  $dist = rad2deg($dist);
                  $miles = $dist * 60 * 1.1515;
                  $unit = strtoupper($unit);
                  if ($unit == "K") {
                    return ($miles * 1.609344);
                  } else if ($unit == "N") {
                    return ($miles * 0.8684);
                  } else {
                    return $miles;
                  }
                }
              }
            $myRange = isset($filters['range'])?$filters['range']:5;
            $finalResult = [];
            foreach ($results as $singleApartment) {
                $distance = round(distance($response['results'][0]['position']['lat'],  $response['results'][0]['position']['lon'], $singleApartment->lat,  $singleApartment->lon, 'K'), 1);
                if ($distance <= $myRange) {
                    $singleApartment->distance = $distance;
                    $singleApartment->link = "http://127.0.0.1:8000/guest/show/" . $singleApartment->id;
                    $finalResult[] = $singleApartment;
                }
            }
            //
        return response()->json([
            'success' => true,
            'params' => $params,
            'results' => $finalResult,
            'position' => $position,
        ]);
    }
    public function stat($id)
    {
        $current_year = date('Y');
        $start_year = strtotime($current_year . "/01/01");
        $date = date("Y-m-d", $start_year);
        $future_year = strtotime('+1 year', $start_year);
        $end_date = date("Y-m-d", $future_year);
        $current_month = (int)date('m');
        $views = View::where('accomodation_id', $id)->where('created_at', '>', $date)->where('created_at', '<', $end_date)->get();
        $calendarV = [
            '1' => [],
            '2' => [],
            '3' => [],
            '4' => [],
            '5' => [],
            '6' => [],
            '7' => [],
            '8' => [],
            '9' => [],
            '10' => [],
            '11' => [],
            '12' => [],
        ];
        foreach ($views as $view) {
            for ($i = 1; $i <= $current_month; $i++) {
                if (date("m", strtotime($view->created_at)) == $i) {
                    $calendarV[$i][] = 'v';
                }
            }
        }
        $statViews = [];
        foreach ($calendarV as $month) {
            $statViews[] = count($month);
        }
        $messages = Message::where('accomodation_id', $id)->where('created_at', '>', $date)->get();
        $calendarM = [
            '1' => [],
            '2' => [],
            '3' => [],
            '4' => [],
            '5' => [],
            '6' => [],
            '7' => [],
            '8' => [],
            '9' => [],
            '10' => [],
            '11' => [],
            '12' => [],
        ];
        foreach ($messages as $message) {
            for ($i = 1; $i <= $current_month; $i++) {
                if (date("m", strtotime($message->created_at)) == $i) {
                    $calendarM[$i][] = 'v';
                }
            }
        }
        $statMessages = [];
        foreach ($calendarM as $month) {
            $statMessages[] = count($month);
        }
        return response()->json([
            'success' => true,
            'views' => array_slice($statViews, 0, $current_month),
            'messages' => array_slice($statMessages, 0, $current_month)
        ]);
    }
}











