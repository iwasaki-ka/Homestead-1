<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kintai;
use Illuminate\Support\Facades\Log;

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

    $kintai_records = Kintai::where('syain_number', $syain_number)
                             ->whereYear('date', $year)
                            ->whereMonth('date', $month)
                             ->get();

    return view('kinmuhyou_detail', ['syain_number' => $syain_number, 'month' => $month, 'kintai_records' => $kintai_records]);
}

public function editKintai($syain_number, $date)
{
    $day = sprintf('%02d', \Carbon\Carbon::createFromFormat('Y-m-d', $date)->day);
    $start_time_property = 'day' . $day . '_start_time';
    $end_time_property = 'day' . $day . '_end_time';
    $break_time_property = 'day' . $day . '_break_time';

    $kintai = Kintai::firstOrCreate(
        ['syain_number' => $syain_number, 'date' => $date],
        array_merge(
            ['syain_number' => $syain_number],
            array_fill_keys(["day{$day}_start_time", "day{$day}_end_time", "day{$day}_break_time"], null)
        )
    );
    Log::info('Created or found kintai: ', $kintai->toArray());

    $start_time = $kintai->$start_time_property;
    $end_time = $kintai->$end_time_property;
    $break_time = $kintai->$break_time_property;

    return view('edit_kintai', [
        'kintai' => $kintai,
        'start_time' => $start_time,
        'end_time' => $end_time,
        'break_time' => $break_time,
    ]);
}

public function updateKintai(Request $request, $id)
{
    $kintai = Kintai::find($id);
    $date = new \DateTime($kintai->date);
    $month = $date->format('Y-m');

    $day = sprintf('%02d', $date->format('d'));

    $start_time_property = 'day' . $day . '_start_time';
    $end_time_property = 'day' . $day . '_end_time';
    $break_time_property = 'day' . $day . '_break_time';

    $kintai->$start_time_property = $date->format('Y-m-d') . ' ' . ($request->start_time ?: '');
    $kintai->$end_time_property = $date->format('Y-m-d') . ' ' . ($request->end_time ?: '');
    $kintai->$break_time_property = $request->break_time ?: 0;

    $kintai->save();
    $syain_number = $kintai->syain_number;

    return redirect()->route('kinmuhyou_detail', ['syain_number' => $syain_number, 'month' => $month]);
}
}

?>
