<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'department_id',
        'position'
    ];

    // The employee's relationship with the department (many to one)
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    // The employee's relationship with projects (many to many)
    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }

    // The employee's relationship with notes (polymorphic relation)
    public function notes()
    {
        return $this->morphMany(Note::class, 'noteable');
    }

    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = ucfirst($value);
    }

    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = ucfirst($value);
    }
}
