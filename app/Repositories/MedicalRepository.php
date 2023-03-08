<?php

namespace App\Repositories;

use App\Models\Medical;
use App\Repositories\AppBaseRepository;

class MedicalRepository extends AppBaseRepository
{
    protected $fieldSearchable = [
        'student_id',
        'height',
        'weight',
        'check_date'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Medical::class;
    }
}
