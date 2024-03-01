<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthKintai extends Model
{
    use HasFactory;

    protected $table = 'month_kintai';
    protected $primaryKey = 'id';

    protected $fillable = [
        'syain_number',
        'month',
        'total_work_hours',
        'total_work_days',
        'id',
    ];
}

?>
