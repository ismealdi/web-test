<?php

namespace App\Models;

class Medical extends AppBaseModel
{
    public $table = 'medicals';

    public $fillable = [
        'student_id',
        'height',
        'weight',
        'eye_right',
        'eye_left',
        'eye_other',
        'tooth',
        'mouth',
        'check_date'
    ];

    protected $casts = [        
        'check_date' => 'date'
    ];

    public static array $rules = [
        'check_date' => 'required',
        'height' => 'required|min:1',
        'weight' => 'required|min:1'
    ];

    public function getCheckDateAttribute($value) {
        return ["id" => $value, "text" => \Carbon\Carbon::parse($value)->format('Y-m-d')];
    }

    public function student(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(\App\Models\Student::class, 'id', 'student_id');
    }

}
