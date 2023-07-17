<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemporaryResidenceAndAbsence extends Model
{
    use HasFactory;

    protected $table = 'temporary_residence_and_absence';

    protected $fillable = [
        'userId',
        'personId',
        'householdId',
        'startDate',
        'endDate',
        'reason',
        'type',
        'beforeAddress'
    ];

    public static function getAllTemporaryResidenceAndAbsence(){
        return  TemporaryResidenceAndAbsence::orderBy('id','DESC')->paginate();
    }

    public function person()
    {
        return $this->belongsTo(Person::class, 'personId', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }
}
