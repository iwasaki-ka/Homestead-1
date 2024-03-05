<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kintai;
use App\Models\MonthKintai;
use Illuminate\Support\Facades\Auth;

class DakokuController extends Controller
{
    public function dakoku_view($syain_number)
    {
        $kintai = Kintai::where('syain_number', $syain_number)->latest()->first();
        return view('dakoku', ['syain_number' => $syain_number, 'kintai' => $kintai]);
    }

public function syukkin(Request $request)
{
    // 社員番号がnullでないことを確認
    if ($request->syain_number) {
        // 今月のレコードを取得または作成
        $kintai = Kintai::create([
            'syain_number' => $request->syain_number,
            'start_time' => now()->format('Y-m-d H:i:s'),
            'end_time' => null,
            'date' => now()->format('Y-m-d'),
            'break_time' => 60,
        ]);
        // 月のレコードを取得または作成し、出勤日数を更新
        $month = now()->format('Y-m');
        $month_kintai = MonthKintai::firstOrCreate(
            ['syain_number' => $request->syain_number, 'month' => $month],
            ['total_work_hours' => 0, 'total_work_days' => 0]
        );
        $month_kintai->total_work_days += 1;
        $month_kintai->save();
        return redirect()->route('dakoku', ['syain_number' => $request->syain_number]);
    } else {
        // エラーメッセージを表示
        return redirect()->back()->withErrors(['message' => '社員番号が存在しません。']);
    }
}

public function taikin(Request $request, $syain_number)
{
    // 最新のレコードを取得
    $kintai = Kintai::where('syain_number', $syain_number)
    ->where('date', now()->format('Y-m-d'))
    ->whereNull('end_time')
    ->orderBy('start_time', 'desc')
    ->first();

    if ($kintai) {
        // 退勤時間を追加
        $kintai->end_time = now()->format('Y-m-d H:i:s');
        $kintai->save();

        // 勤務時間を計算
        $start_time = \Carbon\Carbon::parse($kintai->start_time);
        $end_time = \Carbon\Carbon::parse($kintai->end_time);
        $work_hours = $end_time->diffInMinutes($start_time) / 60;
        \Log::info('Work hours for syain_number: ' . $kintai->syain_number . ' is: ' . $work_hours);


        // 月のレコードを取得し、勤務時間を更新
        $month = now()->format('Y-m');
        $month_kintai = MonthKintai::where('syain_number', $kintai->syain_number)->where('month', $month)->first();
        if ($month_kintai) {
            $month_kintai->total_work_hours += $work_hours;
            $month_kintai->save();
        }

        return redirect()->route('dakoku', ['syain_number' => $kintai->syain_number]);
    } else {
        // エラーメッセージを表示
        // \Log::info("No kintai record found for syain_number: " . $syain_number);
        // \Log::info($kintai);
        return redirect()->back()->withErrors(['message' => '出勤記録が存在しません。先に出勤を登録してください。']);
    }
}



}
