<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use HasFactory;

    protected $table = 'fees';

    protected $fillable = [
        'name',
        'amount',
        'type',
        'startDate',
        'endDate'
    ];

    public static function getAllFees(){
        return  Fee::orderBy('id','DESC')->paginate();
    }

    public function receipts()
    {
        return $this->hasMany(Receipt::class, 'feeId', 'id');
    }
}
