<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'name',
        'description'
    ];


    // The department's relationship with employees (one to many)

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    // The department's relationship with notes (polymorphic relation)

    public function notes()
    {
        return $this->morphMany(Note::class, 'noteable');
    }
}
