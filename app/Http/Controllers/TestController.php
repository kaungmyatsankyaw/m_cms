<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TestController extends Controller
{

    public function __construct()
    {
        date_default_timezone_set('Asia/Yangon');
    }

    public function index()
    {
        return view('test');
    }

    public function count(Request $request)
    {
        $date = $request->get('date');
        $day = explode('-', $date);
        $start_day = $day[0];
//        dd($start_day);
        $end_day = $day[1];
        $end_day = str_replace(' ', '', $end_day);
//        dd($end_day);
        $start = strtotime($start_day);
        $end = strtotime($end_day) + 86400;

        $user = DB::select("select From_UNIXTIME(timetick,'%m-%d-%Y') as date,
          count(*) as count
            from user
            where timetick >= $start 
            and timetick <= $end group  by date order by date desc");
//        dd($user);

        $question_count = DB::select(" 
          select count(DISTINCT(user_id)) as question_count,From_UNIXTIME(question_date,'%m-%d-%Y') as date from tbl_question
            where  question_date >= $start
            and question_date <= $end group  by date order by date desc"

        );
//        dd($question_count);

        $answer_count = DB::select(" 
          select count(*) as answer_count,From_UNIXTIME(ans_send_user_time,'%m-%d-%Y') as date from tbl_question
            where  ans_send_user_time >= $start
            and ans_send_user_time <= $end group  by date  order by date desc"
        );


        $payment_user = DB::select(" 
          select count(*) as finished_count,date as date_finish from status_log
            where date between '$start_day' and '$end_day' and status_id=2 group  by date_finish order by date_finish desc"
        );


        for ($i = 0; $i < count($payment_user); $i++) {
            $payment_user[$i]->date_finish = date('m-d-Y', strtotime($payment_user[$i]->date_finish));
        }

        $out = array();
        foreach ($user as $key => $value) {
            $t['date'] = $value->date;
            $t['user_count'] = $value->count;
            $t['question_count'] = 0;
            $t['answer_count'] = 0;
            $t['payment_count'] = 0;
            foreach ($question_count as $question) {
                if ($question->date == $value->date) {
                    $t['question_count'] = $question->question_count;
                }
            }
            foreach ($answer_count as $answer) {
                if ($answer->date == $value->date) {
                    $t['answer_count'] = $answer->answer_count;
                }
            }
            foreach ($payment_user as $payment) {
                if ($payment->date_finish == $value->date) {
                    $t['payment_count'] = $payment->finished_count;
                }
            }
            $out[] = $t;
            unset($t);
        }
        dd($out);
    }

    public function operator(Request $request)
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
//dd($result);
        $total = DB::select("select From_UNIXTIME(datetime,'%m-%d-%Y') as date,
           sum(amount) as total
            from tbl_creditcard  where operator in ('MPT','Ooredoo','Telenor','MEC') 
            and datetime >= $start 
            and datetime <= $end
            GROUP by 1 order by 1 DESC 
        ");
//dd($total);
        $i = 0;
        $out = array();
        $temp = '';
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
        dd($out);
    }

    public function chart_opera(Request $request)
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

        $i = 0;
        $out = array();
        $temp = '';
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
        dd($out);

    }

}
