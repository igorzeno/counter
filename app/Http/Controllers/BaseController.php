<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;



class BaseController extends Controller
{
    public function index()
    {
        $n_dat = NOW();
        DB::enableQueryLog();

        DB::select("SELECT   Hour AS Hours, COUNT(created_at) AS `usage`
                    FROM visits
                      RIGHT JOIN (
                                       SELECT  0 AS Hour
                             UNION ALL SELECT  1 UNION ALL SELECT  2 UNION ALL SELECT  3  UNION ALL SELECT  4 UNION ALL SELECT  5 UNION ALL SELECT  6
                             UNION ALL SELECT  7 UNION ALL SELECT  8 UNION ALL SELECT  9  UNION ALL SELECT 10 UNION ALL SELECT 11 UNION ALL SELECT 12
                             UNION ALL SELECT 13 UNION ALL SELECT 14 UNION ALL SELECT 15  UNION ALL SELECT 16 UNION ALL SELECT 17 UNION ALL SELECT 18
                             UNION ALL SELECT 19 UNION ALL SELECT 20 UNION ALL SELECT 21  UNION ALL SELECT 22 UNION ALL SELECT 23
                      )      AS AllHours ON HOUR(created_at) = Hour
                    WHERE    created_at BETWEEN '2021-02-14 00:00:00' AND '$n_dat'
                    GROUP BY Hour
                    ORDER BY Hour DESC");
        dd(DB::getQueryLog());



//        DB::enableQueryLog();
//        $visits = DB::table("visits")
//            ->select("Hour AS Hours", "COUNT(created_at) AS `usage`")
//            ->rightJoin(
//                DB::raw("SELECT  0 AS Hour
//         UNION ALL SELECT  1 UNION ALL SELECT  2 UNION ALL SELECT  3  UNION ALL SELECT 4
//         UNION ALL SELECT  5 UNION ALL SELECT  6 UNION ALL SELECT  7 UNION ALL SELECT  8
//         UNION ALL SELECT  9  UNION ALL SELECT 10 UNION ALL SELECT 11 UNION ALL SELECT 12
//         UNION ALL SELECT 13 UNION ALL SELECT 14 UNION ALL SELECT 15  UNION ALL SELECT 16
//         UNION ALL SELECT 17 UNION ALL SELECT 18 UNION ALL SELECT 19 UNION ALL SELECT 20
//         UNION ALL SELECT 21  UNION ALL SELECT 22 UNION ALL SELECT 23 )
//         AS AllHours ON HOUR(created_at) = Hour" ) )
//                    ->whereBetween("created_at", ['2021-02-14 00:00:00', '2021-02-14 23:59:59'])
//                    ->groupBy("Hour")
//                    ->orderBy("Hour")
//                    ->get();
//        dd(DB::getQueryLog());
    }

}
