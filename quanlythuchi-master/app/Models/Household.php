<?php

namespace App\Models;

use App\Models\HouseholdMember;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Household extends Model
{
    use HasFactory;

    protected $table = 'households';

    protected $fillable = [
        'address',
        // 'ownerId'
    ];

    public static function getAllHouseholds(){
        return  Household::orderBy('id','DESC')->paginate();
    }

    public function members()
    {
        return $this->hasMany(HouseholdMember::class, 'householdId', 'id');
    }

    public function receipts()
    {
        return $this->hasMany(Receipt::class, 'householdId', 'id');
    }

}
