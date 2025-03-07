<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

use App\Models\inventory;

class category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function inventory(){
        return $this->hasMany(inventory::class);
    }
}
