<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TelenorController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Yangon');
    }

    public function show()
    {
        return view('operator.telenor');
    }

    public function chart(Request $request)
    {
        $date = $request->get('date');
        $day = explode('-', $date);
        $start_day = $day[0];
        $end_day = $day[1];

        $start = strtotime($start_day);
//        dd($start);
        $end = strtotime($end_day) + 86400;
//        dd($end);

        $result = DB::select("select From_UNIXTIME(datetime,'%m-%d-%Y') as date,
            operator,sum(amount) as total
            from tbl_creditcard  where operator='Telenor' 
            and datetime >= $start 
            and datetime <= $end
            GROUP by 1 order by 1 DESC 
        ");

        $total = DB::select("select From_UNIXTIME(datetime,'%m-%d-%Y') as date,
           sum(amount) as total
            from tbl_creditcard  where operator='Telenor'
            and datetime >= $start 
            and datetime <= $end
            GROUP by 1 order by 1 DESC 
        ");
//        echo '<pre>';
//        print_r($result);
//        echo '</pre>';
//        dd($total);
        $i = 0;
        $out = array();
        $temp = '';
        foreach ($result as $key => $value) {
            if ($temp == '') {
                $t['date'] = $value->date;
                $t[$value->operator] = $value->total;
                foreach ($total as $tot) {
                    if ($tot->date == $value->date) {
                        $t['total'] = $tot->total;
                    }
                }
            }
            $out[] = $t;
            unset($t);
        }
        $out = response()->json($out);
        return $out;
    }


}
