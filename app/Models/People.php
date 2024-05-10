<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class People extends Model
{
    use HasFactory;

    protected $fillable  = [
        'name',
        'email',
        'age',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static array $rules = [
        'name' => 'required|max:255',
        'email' => 'required|email|unique:people',
        'age' => 'required|integer',
    ];

}
