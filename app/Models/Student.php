<?php

namespace App\Models;

class Student extends AppBaseModel
{
    
    public const GENDER = ['' => '', 'Pria' => 'Pria', 'Wanita' => 'Wanita'];
    public const GROUP = ['' => '', 1 => 'TK A', 2 => 'TK B'];

    public $table = 'students';

    public $fillable = [
        'nis',
        'name',
        'gender',
        'group',
        'dob',
        'parent_name'
    ];

    protected $casts = [        
        'dob' => 'date'
    ];

    public static array $rules = [];

    protected function getGenderAttribute($value)
    {        
        return ["id" => $value, "text" => $value];
    }

    protected function getGroupAttribute($value)
    {        
        return ["id" => $value, "text" => $this::GROUP[$value]];
    }

    public function getDobAttribute($value) {
        return ["id" => $value, "text" => \Carbon\Carbon::parse($value)->format('Y-m-d')];
    }
    

}
