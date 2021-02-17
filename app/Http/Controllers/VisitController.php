<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisitController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $n_dat = NOW();
        $visits = DB::select("SELECT   Hour AS Hours, COUNT(created_at) AS `usage`
                    FROM visits
                      RIGHT JOIN (
                                       SELECT  0 AS Hour
                             UNION ALL SELECT  1 UNION ALL SELECT  2 UNION ALL SELECT  3  UNION ALL SELECT  4 UNION ALL SELECT  5 UNION ALL SELECT  6
                             UNION ALL SELECT  7 UNION ALL SELECT  8 UNION ALL SELECT  9  UNION ALL SELECT 10 UNION ALL SELECT 11 UNION ALL SELECT 12
                             UNION ALL SELECT 13 UNION ALL SELECT 14 UNION ALL SELECT 15  UNION ALL SELECT 16 UNION ALL SELECT 17 UNION ALL SELECT 18
                             UNION ALL SELECT 19 UNION ALL SELECT 20 UNION ALL SELECT 21  UNION ALL SELECT 22 UNION ALL SELECT 23
                      )      AS AllHours ON HOUR(created_at) = Hour
                    WHERE    created_at BETWEEN '2021-02-14 00:00:00' AND '$n_dat' OR created_at IS NULL
                    GROUP BY Hour
                    ORDER BY Hour DESC");
//        dd($visits);

        if (isset($visits)) {

            $vis = [];
            foreach($visits as $key => $val) {
                $vis[] = [
                    //'label' => $str,
                    'x' => intval($val->Hours),
                    'y' => $val->usage
                ];
            }
            // dd($ci_name);
            $res =  json_encode($vis, JSON_UNESCAPED_UNICODE);
        }
        //dd($res);
        return view('visit.index', [
            'res' => $res,
        ]);
    }
    public function store(Request $request) {
        $cities = array("Moscow", "Kazan", "Rome", "Madrid", "Stambul");
        $city = $cities[array_rand($cities)];
        $ips = array("79.11.240.46","180.249.234.228","190.111.82.204","78.56.214.229","178.157.249.132","170.84.229.45");
        $ip = $ips[array_rand($ips)];

        $visit = Visit::create([
            'ip' => $ip,
            'city' => $city,
            'device' => $request->oscpu_param,
            'url' => $request->url_param,
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);

        dd('OK');
    }
}

