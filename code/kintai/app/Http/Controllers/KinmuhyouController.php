<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kintai;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class KinmuhyouController extends Controller
{
    public function dakoku_view($syain_number)
    {
        $kintai = Kintai::where('syain_number', $syain_number)->latest()->first();
        return view('dakoku', ['syain_number' => $syain_number, 'kintai' => $kintai]);
    }

    public function showKintai($syain_number)
{
    $months = Kintai::where('syain_number', $syain_number)
                    ->selectRaw('DISTINCT DATE_FORMAT(date, "%Y-%m") as month')
                    ->get();

    return view('kinmuhyou', ['syain_number' => $syain_number, 'months' => $months]);
}

public function kinmuhyou_detail($syain_number, $month)
{
    [$year, $month] = explode('-', $month);

    $kintai_records = [];
    for ($day = 1; $day <= 31; $day++) {
        $day_padded = sprintf('%02d', $day);
        $start_time_property = 'day' . $day_padded . '_start_time';
        $end_time_property = 'day' . $day_padded . '_end_time';
        $break_time_property = 'day' . $day_padded . '_break_time';

        $kintai_record = Kintai::where('syain_number', $syain_number)
                                ->whereYear('date', $year)
                                ->whereMonth('date', $month)
                                ->whereDay('date', $day)
                                ->orderBy('created_at', 'desc')
                                ->first();

        if ($kintai_record) {
            $kintai_records[$day_padded] = $kintai_record;
        }
    }

    return view('kinmuhyou_detail', ['syain_number' => $syain_number, 'month' => $month, 'kintai_records' => $kintai_records]);
}

public function editKintai($syain_number, $date)
{
    $day = sprintf('%02d', \Carbon\Carbon::createFromFormat('Y-m-d', $date)->day);
    $start_time_property = 'day' . $day . '_start_time';
    $end_time_property = 'day' . $day . '_end_time';
    $break_time_property = 'day' . $day . '_break_time';

    $kintai = Kintai::firstWhere(['syain_number' => $syain_number, 'date' => $date]);

    if ($kintai) {
        $start_time = $kintai->$start_time_property;
        $end_time = $kintai->$end_time_property;
        $break_time = $kintai->$break_time_property;
    } else {
        $start_time = $end_time = $break_time = null;
    }

    return view('edit_kintai', compact('syain_number', 'date', 'kintai', 'start_time', 'end_time', 'break_time'));
}

public function updateKintai(Request $request, $syain_number, $date)
{
    $date = new \DateTime($date);
    $month = $date->format('Y-m');
    $day = sprintf('%02d', $date->format('d'));

    $start_time_property = 'day' . $day . '_start_time';
    $end_time_property = 'day' . $day . '_end_time';
    $break_time_property = 'day' . $day . '_break_time';

    $kintai = Kintai::where('syain_number', $syain_number)
    ->where('date', 'like', $month . '%')
    ->first();

    if ($kintai) {
        if ($request->start_time !== null) {
            $kintai->$start_time_property = $date->format('Y-m-d') . ' ' . $request->start_time;
        }
        if ($request->end_time !== null) {
            $kintai->$end_time_property = $date->format('Y-m-d') . ' ' . $request->end_time;
        }
        if (isset($request->break_time)) {
            $kintai->$break_time_property = $request->break_time;
        }
        $kintai->save();
    }


    return redirect()->route('kinmuhyou_detail', ['syain_number' => $syain_number, 'month' => $month]);
}
}


?>
