<?php

namespace App\Models;

use App\Models\StudentGrantee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Grantee extends Model
{
    use HasFactory;
    protected $table = 'grantees';
    protected $fillable = [
        'student_id',
        'semester',
        'school_year',
        'scholarship_name',
        'scholarship_type',
    ];

    public function scholarshipName()
    {
        return $this->belongsTo(ScholarshipName::class);
    }
}
