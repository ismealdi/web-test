<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Support\Str;

class AppBaseModel extends Model
{
    use SoftDeletes, HasUuids;
    
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected static function booted()
    {
        static::creating(function ($model) {
            // formating phone mask
            if (isset($model->phone)) {
                $model->phone = $model->formatPhone($model->phone);
            }            
        });

        static::updating(function ($model) {
            // formating phone mask
            if (isset($model->phone)) {
                $model->phone = $model->formatPhone($model->phone);
            }
        });
    }

    private function formatPhone($number): String {
        return str_replace("_", "", str_replace(" ", "", $number));
    }
}
