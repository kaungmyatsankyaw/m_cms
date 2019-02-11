<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Datatables;

class ReportController extends Controller
{
    public function __construct(){
        date_default_timezone_set("Asia/Yangon");
    }
    public function index()
    {
        return view('astrologer.index');
    }
    public function show(Request $request)
    {

        $date = $request->get('date');
        $day = explode('-', $date);
        $start_day = $day[0];
        $end_day = $day[1];

        $start = strtotime($start_day);
        $end = strtotime($end_day) + 86400;

        $result = DB::select("select astro_name as Astrologer,count(*) as count,
            From_UNIXTIME(timetick,'%m-%d-%Y') as date from tbl_question
            where timetick >= $start and timetick <= $end group by date,Astrologer
            ORDER  BY date  DESC ");

//
        $sum = DB::select("select count(*) as total,From_UNIXTIME(timetick,'%m-%d-%Y') as date
            from tbl_question where timetick >= $start and timetick <= $end GROUP  BY 
            date ORDER by date Desc ");
//         dd($result);


//        return Datatables::of($result)->toJson();
        $i = 0;
        $out = array();
        $temp = '';
        foreach ($result as $key => $value) {
            if ($temp == '') {
//                $out[$i]['date']=date('d-m-Y',strtotime($value->date));
                $out[$i]['date'] = $value->date;
                $out[$i]['astrologer'] = array_fill_keys(array('ဆရာမ ေဒၚသီရိထက္စိုး', 'ဆရာမေဒၚဆုလဲ့ရတနာ', 'ဆရာမေဒၚယမင္းေအာင္',
                    'ဆရာဦး၀င္းေဇာ္ ( သစ္ေတာ )', 'ဆရာဦးေက်ာ္ေဇာသိမ္း'), 0);
                $out[$i]['astrologer'][$value->Astrologer] = $value->count;
                foreach ($sum as $tot) {
                    if ($tot->date == $value->date) {
                        $out[$i]['total'] = $tot->total;
                    }
                }
                $temp = $value->date;
            } else {
                if ($temp == $value->date) {
                    $out[$i]['astrologer'][$value->Astrologer] = $value->count;
                    foreach ($sum as $tot) {
                        if ($tot->date == $value->date) {
                            $out[$i]['total'] = $tot->total;
                        }
                    }
                    $temp = $value->date;
                } else {
                    $i++;
//                    $out[$i]['date']=date('d-m-Y',strtotime($value->date));
                    $out[$i]['date'] = $value->date;
                    $out[$i]['astrologer'] = array_fill_keys(array('ဆရာမ ေဒၚသီရိထက္စိုး', 'ဆရာမေဒၚဆုလဲ့ရတနာ', 'ဆရာမေဒၚယမင္းေအာင္',
                        'ဆရာဦး၀င္းေဇာ္ ( သစ္ေတာ )', 'ဆရာဦးေက်ာ္ေဇာသိမ္း'), 0);
                    $out[$i]['astrologer'][$value->Astrologer] = $value->count;
                    foreach ($sum as $tot) {
                        if ($tot->date == $value->date) {
                            $out[$i]['total'] = $tot->total;
                        }
                    }

                    $temp = $value->date;
                }
            }
//            $i++;
        }
        $out = collect($out);
        return DataTables::of($out)
            ->make(true);
    }
}
