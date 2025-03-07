<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\category;

class inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'itemName',
        'price',
        'amount',
        'image',
    ];

    public function category(){
        return $this->belongsTo(category::class);
    }
}
