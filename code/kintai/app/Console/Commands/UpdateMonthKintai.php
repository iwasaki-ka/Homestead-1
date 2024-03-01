<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Kintai;
use App\Models\MonthKintai;
use Carbon\Carbon;

class UpdateMonthKintai extends Command
{
    protected $signature = 'update:monthkintai';

    protected $description = 'Update month_kintai table based on kintai table';

    public function handle()
    {
        // Get all unique syain_numbers and months from kintai table
        $records = Kintai::select('syain_number', 'date')
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->date)->format('Y-m'); // grouping by year-month
            });

            foreach ($records as $month => $kintais) {
                foreach ($kintais->groupBy('syain_number') as $syain_number => $kintai) {
                    $total_work_hours = $kintai->sum(function ($kintai) {
                        if (!empty($kintai->start_time) && !empty($kintai->end_time)) {
                            $start_time = Carbon::parse($kintai->start_time);
                            $end_time = Carbon::parse($kintai->end_time);
                            return $end_time->diffInMinutes($start_time) / 60;
                        }
                        return 0;
                    });


                $total_work_days = $kintai->count();

                // Update or create the record in month_kintai table
                MonthKintai::updateOrCreate(
                    ['syain_number' => $syain_number, 'month' => $month],
                    ['total_work_hours' => $total_work_hours, 'total_work_days' => $total_work_days]
                );
            }
        }

        $this->info('month_kintai table has been updated successfully.');
    }
}
