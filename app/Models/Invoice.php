<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    
    protected $fillable = ['student_id', 'title', 'amount', 'is_paid', 'due_date'];

    protected $casts = [
        'due_date' => 'date',
        'is_paid' => 'boolean',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
