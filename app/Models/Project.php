<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',

    ];



    // The relationship of the project with the employees (many to many)
    public function employees()
    {
        return $this->belongsToMany(Employee::class);
    }

}
