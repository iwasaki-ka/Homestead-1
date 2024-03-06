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
        'created_at'
    ];

    public function __construct() {
        for ($i = 1; $i <= 31; $i++) {
            array_push($this->fillable, "day{$i}_start_time", "day{$i}_end_time", "day{$i}_break_time");
        }
    }

}
