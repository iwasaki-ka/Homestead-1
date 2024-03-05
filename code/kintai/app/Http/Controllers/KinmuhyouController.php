<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kintai;
use App\Models\MonthKintai;

class KinmuhyouController extends Controller
{


    public function dakoku_view($syain_number)
{
    $kintai = Kintai::where('syain_number', $syain_number)->latest()->first();
    return view('dakoku', ['syain_number' => $syain_number, 'kintai' => $kintai]);
}

public function showKintai($syain_number)
{
    $month_kintai_records = MonthKintai::where('syain_number', $syain_number)->orderBy('month', 'desc')->get();

    foreach ($month_kintai_records as $record) {
        $this->calculateTotals($syain_number, $record->month);
    }

    $month_kintai_records = MonthKintai::where('syain_number', $syain_number)->orderBy('month', 'desc')->get();

    return view('kinmuhyou', ['syain_number' => $syain_number, 'month_kintai_records' => $month_kintai_records]);
}


public function kinmuhyou_detail($syain_number, $month)
{
    $kintai_records = Kintai::where('syain_number', $syain_number)->whereMonth('date', date('m', strtotime($month)))->get();
    return view('kinmuhyou_detail', ['syain_number' => $syain_number, 'month' => $month, 'kintai_records' => $kintai_records]);
}

public function editKintai($syain_number, $date)
{
    $kintai = Kintai::where('syain_number', $syain_number)->where('date', $date)->first();
    if (!$kintai) {
        return redirect()->back()->withErrors(['message' => '指定した社員番号と日付の勤務記録が見つかりませんでした。']);
    }
    return view('edit_kintai', ['kintai' => $kintai]);
}

public function updateKintai(Request $request, $id)
{
    $kintai = Kintai::find($id);
    $date = new \DateTime($kintai->date);
    $month = $date->format('Y-m');

    $kintai->start_time = $date->format('Y-m-d') . ' ' . $request->start_time;
    $kintai->end_time = $date->format('Y-m-d') . ' ' . $request->end_time;
    $kintai->break_time = $request->break_time;
    $kintai->save();
    $syain_number = $kintai->syain_number;

    $this->calculateTotals($syain_number, $month);

    return redirect()->route('kinmuhyou_detail', ['syain_number' => $syain_number, 'month' => $month]);
}

public function calculateTotals($syain_number, $month)
{
    $month_kintai = MonthKintai::where('syain_number', $syain_number)->where('month', $month)->first();
    if ($month_kintai) {
        $month_kintai->total_work_hours = 0;
        $month_kintai->total_work_days = 0;

        $kintai_records = Kintai::where('syain_number', $syain_number)->whereMonth('date', date('m', strtotime($month)))->get();

        foreach ($kintai_records as $record) {
            $start_time = \Carbon\Carbon::parse($record->start_time);
            $end_time = \Carbon\Carbon::parse($record->end_time);
            $break_time = $record->break_time / 60;
            $work_hours = $end_time->diffInMinutes($start_time) / 60 - $break_time;

            $month_kintai->total_work_hours += $work_hours;
            $month_kintai->total_work_days += 1;
        }

        $month_kintai->save();
    }
}

}


?>
