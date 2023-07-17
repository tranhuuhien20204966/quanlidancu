<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;

    protected $table = 'receipts';

    protected $fillable = [
        'userId',
        'householdId',
        'personId',
        'feeId',
        'amount',
        'note'
    ];

    public static function getAllReceipts(){
        return  Receipt::orderBy('id','DESC')->paginate();
    }

    public function person()
    {
        return $this->belongsTo(Person::class, 'personId', 'id');
    }

    public function fee()
    {
        return $this->belongsTo(Fee::class, 'feeId', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }

    public function household()
    {
        return $this->belongsTo(Household::class, 'householdId', 'id');
    }
}
