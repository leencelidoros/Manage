<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Manager;
use App\Models\Employee;
use App\Models\Supplier;
class Supermarket extends Model
{
    protected $fillable = [
        'name',
        'location',

    ];
    public function managers()
    {
        return $this->hasMany(Manager::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class, 'manager_id');
    }

    public function suppliers()
    {
        return $this->hasMany(Supplier::class);
    }

}
