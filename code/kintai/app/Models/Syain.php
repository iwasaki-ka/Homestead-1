<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class Syain extends Model implements Authenticatable
{
    use HasFactory, AuthenticableTrait;

    protected $table = 'syain';


    protected $fillable = [
        'syain_number',
        'name',
        'syozoku',
        'user_type',
    ];
}

?>
