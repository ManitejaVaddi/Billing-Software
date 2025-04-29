<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    // Specify the table name if it does not follow Laravel's naming conventions
    protected $table = 'customers';

    // Specify the fields that can be mass-assigned
    protected $fillable = ['name', 'email', 'phone', 'address'];
}
