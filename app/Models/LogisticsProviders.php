<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogisticsProviders extends Model
{
    use HasFactory;

    protected $table = 'logistics_providers';

    protected $fillable = [
        'name', 'cost'
    ];
}
