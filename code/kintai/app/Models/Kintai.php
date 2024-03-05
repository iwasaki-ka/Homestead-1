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
        'start_time',
        'end_time',
        'id',
        'break_time',
    ];
}
