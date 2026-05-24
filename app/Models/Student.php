<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_id',
        'student_id_number',
        'name',
        'email',
    ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    public function averageGrade(): float
    {
        return round((float) $this->grades->avg('grade'), 2);
    }

    public function remarks(): string
    {
        return $this->averageGrade() >= 75 ? 'PASS' : 'FAIL';
    }
}
