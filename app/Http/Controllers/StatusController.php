<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Datatables;

//use Datatables;

class StatusController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Yangon');
    }

    public function index()
    {
        return view('status.index');
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

        $result = DB::select(DB::raw("select status.name as status_name,
          From_UNIXTIME(timetick,'%m-%d-%Y') as date, count(*) as total
            from tbl_question,status  where status in (1,2,3,6,7) and timetick >= $start and timetick <= $end 
           and tbl_question.status=status.idx GROUP by date,status_name ORDER by date DESC 
        "));
//        dd($result);
//        die();
        $total = DB::select("select From_UNIXTIME(timetick,'%m-%d-%Y') as date,
            Group_concat(DISTINCT(status)) as status,count(*) as total
            from tbl_question where status in (1,2,3,6,7) and timetick >= $start and timetick <= $end
            GROUP by date ORDER BY date DESC 
        ");
//            dd($total);
//            die();

        $i = 0;
        $out = array();
        $temp = '';
        foreach ($result as $key => $value) {
            if ($temp == '') {
//                    $out[$i]['date']=date('d-m-Y',strtotime($value->date));
                $out[$i]['date'] = $value->date;
                $out[$i]['status'] = array_fill_keys(array('Ph Contact Finish', 'Payment Finish', 'Question Send To Astrologer', 'Answer  Reply From Astrologer',
                    'Audio and Text Edit Finish', 'CMS Finished', 'Confirmed', 'No Pickup', 'Can Contact',
                    'Busy', 'Wrong Number', 'Out of Service Area', 'Power Off', 'OverSea Number'), 0);
                $out[$i]['status'][$value->status_name] = $value->total;
                foreach ($total as $tot) {
                    if ($tot->date == $value->date) {
                        $out[$i]['total'] = $tot->total;
                    }
                }
                $temp = $value->date;
            } else {
                if ($temp == $value->date) {
                    $out[$i]['status'][$value->status_name] = $value->total;
                    foreach ($total as $tot) {
                        if ($tot->date == $value->date) {
                            $out[$i]['total'] = $tot->total;
                        }
                    }
                    $temp = $value->date;
                } else {
                    $i++;

                    $out[$i]['date'] = $value->date;
                    $out[$i]['status'] = array_fill_keys(array('Ph Contact Finish', 'Payment Finish', 'Question Send To Astrologer', 'Answer  Reply From Astrologer',
                        'Audio and Text Edit Finish', 'CMS Finished', 'Confirmed', 'No Pickup', 'Can Contact',
                        'Busy', 'Wrong Number', 'Out of Service Area', 'Power Off', 'OverSea Number'), 0);
                    $out[$i]['status'][$value->status_name] = $value->total;
                    foreach ($total as $tot) {
                        if ($tot->date == $value->date) {
                            $out[$i]['total'] = $tot->total;
                        }
                    }
                    $temp = $value->date;
                }
            }
//            $i++;
        }

//        dd($out);
//        die();


        $out = collect($out);
        $result = Datatables::of($out)->make(true);
        return $result;

    }
}
