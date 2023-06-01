<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    //use HasFactory;
    protected $fillable = [
        'name',
        'phone',
        'email',
        'supermarket_id',
    ];
    public function Manager()
    {
        return $this->belongsTo(Supermarket::class);
    }
}
