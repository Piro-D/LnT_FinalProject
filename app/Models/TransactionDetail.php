<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\inventory;
use App\Models\TransactionHeader;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_header_id',
        'inventories_id',
        'amount',
        'price',
    ];

    public function inventory(){
        return $this->belongsTo(inventory::class,  'inventories_id');
    }

    public function transactionHeader(){
        return $this->belongsTo(TransactionHeader::class);
    }
}
