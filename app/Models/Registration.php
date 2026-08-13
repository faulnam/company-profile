<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name', 'origin_school', 'phone', 'status',
        'parent_name', 'parent_email', 'parent_password',
        'payment_status', 'payment_method', 'test_score', 'major_id'
    ];
}
