<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;


class ChartController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set("Asia/Yangon");
    }

    public function operator()
    {
        return view('operator.chart');
    }

    public function chart(Request $request)
    {
        $date = $request->get('date');
        $day = explode('-', $date);
        $start_day = $day[0];
        $end_day = $day[1];

        $start = strtotime($start_day);
        $end = strtotime($end_day) + 86400;

        $result = DB::select("select From_UNIXTIME(datetime,'%m-%d-%Y') as date,
            operator,sum(amount) as total
            from tbl_creditcard  where operator in ('MPT','Ooredoo','Telenor')
            and datetime >= $start
            and datetime <= $end
            GROUP by 1,operator order by 1 DESC
        ");

        $total = DB::select("select From_UNIXTIME(datetime,'%m-%d-%Y') as date,
           sum(amount) as total
            from tbl_creditcard  where operator in ('MPT','Ooredoo','Telenor')
            and datetime >= $start
            and datetime <= $end
            GROUP by 1 order by 1 DESC
        ");

        $out = array();
        foreach ($total as $key => $value) {
            $t['date'] = $value->date;
//            $t['operator']['MEC'] = 0;
            $t['operator']['MPT'] = 0;
            $t['operator']['Ooredoo'] = 0;
            $t['operator']['Telenor'] = 0;
            foreach ($result as $operator=>$total){
                if($value->date==$total->date){
                    if($total->operator=='MPT'){
                        $t['operator']['MPT']=$total->total;
                    }
                    if($total->operator=='Ooredoo'){
                        $t['operator']['Ooredoo']=$total->total;
                    }
                    if($total->operator=='Telenor'){
                        $t['operator']['Telenor']=$total->total;
                    }
                }
            }

            $t['total'] = $value->total;

            $out[] = $t;
            unset($t);
        }

        $out = response()->json($out);
        return $out;
    }

    

}
