<?php

namespace App\Imports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;

class EmployeeImport implements ToModel
{
    private $manager;

    public function __construct($manager)
    {
        $this->manager = $manager;
    }

    public function model(array $row)
    {
        return new Employee([
            'name' => $row[0],
            'type' => $row[1],
            'manager_id' => $this->manager->id,
            // Fill in the employee details here
        ]);
    }
}

