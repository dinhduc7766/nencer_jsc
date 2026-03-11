<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;

    protected $table = 'receipts';

    protected $fillable = [
        'storage_id', 'category_id', 'total_price', 'quantity', 'note',
        'delivery_date', 'type', 'user_id', 'image', 'name', 
        'logistics_provider_id', 'status'
    ];

    public function storage() {
        // Co the su dung belongTo()
        return $this->hasOne(Storage::class, 'id', 'storage_id');
    }

    public function category() {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}
