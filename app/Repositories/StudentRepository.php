<?php

namespace App\Repositories;

use App\Models\Student;
use App\Repositories\AppBaseRepository;

class StudentRepository extends AppBaseRepository
{
    protected $fieldSearchable = [
        'nis',
        'name',
        'parent_name'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Student::class;
    }
}
