<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nis', 'nisn', 'name', 'gender', 'birth_place', 'birth_date', 
        'address', 'parent_phone', 'classroom_id', 'parent_id'
    ];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }
}
