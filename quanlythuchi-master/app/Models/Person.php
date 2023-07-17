<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Person extends Model
{
    use HasFactory;

    protected $table = 'persons';

    protected $fillable = [
        'idCard',
        'firstName',
        'lastName',
        'dateOfBirth',
        'gender',
        'email',
        'numberPhone',
        'ethnic',
        'nationality',
        'address',
        'occupation',
        'educationLevel',
        'maritalStatus',
        'status',
    ];

    public static function getAllPeople(){
        return  Person::orderBy('id','DESC')->paginate();
    }

    public function age()
    {
        return Carbon::parse($this->attributes['dateOfBirth'])->age;
    }

    public function getNameAttribute()
    {
        return $this->lastName . ' ' . $this->firstName;
    }


    public function household()
    {
        return $this->hasOne(HouseholdMember::class, 'personId', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'personId', 'id');
    }

    public function temporaries()
    {
        return $this->hasMany(TemporaryResidenceAndAbsence::class, 'personId', 'id');
    }

    public function receipts()
    {
        return $this->hasMany(Receipt::class, 'personId', 'id');
    }
}
