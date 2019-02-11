<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class MptController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Yangon');
    }
    public function show(){
        return view('operator.mpt');
    }

    public function chart(Request $request){
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
            from tbl_creditcard  where operator='MPT' 
            and datetime >= $start 
            and datetime <= $end
            GROUP by 1 order by 1 DESC 
        ");

        $total = DB::select("select From_UNIXTIME(datetime,'%m-%d-%Y') as date,
           sum(amount) as total
            from tbl_creditcard  where operator='MPT'
            and datetime >= $start 
            and datetime <= $end
            GROUP by 1 order by 1 DESC 
        ");

        $i = 0;
        $out = array();
        $temp = '';

        foreach ($result as $key=>$value){
            $t['date']=$value->date;
            $t[$value->operator]=$value->total;
            foreach ($total as $tot){
                if($value->date==$tot->date){
                    $t['total']=$tot->total;
                }
            }
            $out[]=$t;
            unset($t);
        }
//        foreach ($result as $key => $value) {
//            if ($temp == '') {
//                $out[$i]['date'] = $value->date;
//                $out[$i][$value->operator] = $value->total;
//                foreach ($total as $tot){
//                    if($tot->date==$value->date){
//                        $out[$i]['total']=$tot->total;
//                    }
//                }
//                $temp = $value->date;
//            } else {
//                if ($temp == $value->date) {
//                    $out[$i][$value->operator] = $value->total;
//                    foreach ($total as $tot){
//                        if($tot->date==$value->date){
//                            $out[$i]['total']=$tot->total;
//                        }
//                    }
//                    $temp = $value->date;
//                } else {
//                    $i++;
//                    $out[$i]['date'] = $value->date;
////                    $out[$i]['operator'] = array_fill_keys(array('MEC', 'MPT', 'Ooreedoo', 'Telenor'), 0);
//                    $out[$i][$value->operator] = $value->total;
//                    foreach ($total as $tot){
//                        if($tot->date==$value->date){
//                            $out[$i]['total']=$tot->total;
//                        }
//                    }
//
//                    $temp = $value->date;
//                }
//            }
////            $i++;
//        }
        $out = response()->json($out);
        return $out;
    }
}
