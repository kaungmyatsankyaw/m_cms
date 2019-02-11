<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Datatables;
class OperatorController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Yangon');
    }

    public function index()
    {
        return view('operator.index');
    }

    public function show(Request $request)
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
            from tbl_creditcard  where operator in ('MPT','Ooredoo','Telenor','MEC') 
            and datetime >= $start 
            and datetime <= $end
            GROUP by 1,operator order by 1 DESC 
        ");

        $total = DB::select("select From_UNIXTIME(datetime,'%m-%d-%Y') as date,
           sum(amount) as total
            from tbl_creditcard  where operator in ('MPT','Ooredoo','Telenor','MEC') 
            and datetime >= $start 
            and datetime <= $end
            GROUP by 1 order by 1 DESC 
        ");

        $i = 0;
        $out = array();

        foreach ($total as $key => $value) {
            $t['date'] = $value->date;
            $t['operator']['MEC'] = 0;
            $t['operator']['MPT'] = 0;
            $t['operator']['Ooredoo'] = 0;
            $t['operator']['Telenor'] = 0;
            foreach ($result as $operator=>$total){
                if($value->date==$total->date){
                    if($total->operator=='MEC'){
                        $t['operator']['MEC']=$total->total;
                    }
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
//        dd($out);
//        die();
        $out=collect($out);
        $result=Datatables::of($out)->make(true);
        return $result;
//        $result=$out;
//        return view('operator.result',compact('result'));
    }
}
