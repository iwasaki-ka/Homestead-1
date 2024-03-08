<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kintai extends Model
{
    use HasFactory;

    protected $table = 'kintai';
    protected $primaryKey = 'id';

    protected $fillable = [
        'syain_number',
        'date',
        'updated_at',
        'created_at',
        'day01_start_time', 'day01_end_time', 'day01_break_time',
        'day02_start_time', 'day02_end_time', 'day02_break_time',
        'day03_start_time', 'day03_end_time', 'day03_break_time',
        'day04_start_time', 'day04_end_time', 'day04_break_time',
        'day05_start_time', 'day05_end_time', 'day05_break_time',
        'day06_start_time', 'day06_end_time', 'day06_break_time',
        'day07_start_time', 'day07_end_time', 'day07_break_time',
        'day08_start_time', 'day08_end_time', 'day08_break_time',
        'day09_start_time', 'day09_end_time', 'day09_break_time',
        'day10_start_time', 'day10_end_time', 'day10_break_time',
        'day11_start_time', 'day11_end_time', 'day11_break_time',
        'day12_start_time', 'day12_end_time', 'day12_break_time',
        'day13_start_time', 'day13_end_time', 'day13_break_time',
        'day14_start_time', 'day14_end_time', 'day14_break_time',
        'day15_start_time', 'day15_end_time', 'day15_break_time',
        'day16_start_time', 'day16_end_time', 'day16_break_time',
        'day17_start_time', 'day17_end_time', 'day17_break_time',
        'day18_start_time', 'day18_end_time', 'day18_break_time',
        'day19_start_time', 'day19_end_time', 'day19_break_time',
        'day20_start_time', 'day20_end_time', 'day20_break_time',
        'day21_start_time', 'day21_end_time', 'day21_break_time',
        'day22_start_time', 'day22_end_time', 'day22_break_time',
        'day23_start_time', 'day23_end_time', 'day23_break_time',
        'day24_start_time', 'day24_end_time', 'day24_break_time',
        'day25_start_time', 'day25_end_time', 'day25_break_time',
        'day26_start_time', 'day26_end_time', 'day26_break_time',
        'day27_start_time', 'day27_end_time', 'day27_break_time',
        'day28_start_time', 'day28_end_time', 'day28_break_time',
        'day29_start_time', 'day29_end_time', 'day29_break_time',
        'day30_start_time', 'day30_end_time', 'day30_break_time',
        'day31_start_time', 'day31_end_time', 'day31_break_time',
    ];
    
    public function updateDay($day, $start_time, $end_time, $break_time)
    {
        $start_time_property = 'day' . $day . '_start_time';
        $end_time_property = 'day' . $day . '_end_time';
        $break_time_property = 'day' . $day . '_break_time';

        $this->$start_time_property = $start_time;
        $this->$end_time_property = $end_time;
        $this->$break_time_property = $break_time;

        $this->save();
    }

}
