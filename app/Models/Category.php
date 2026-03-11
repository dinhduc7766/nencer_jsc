<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Receipt;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'id', 'name', 'created_at', 'updated_at'
    ];

    public function receipts() {
        return $this->hasMany(Receipt::class, 'category_id', 'id');
    }
 }
