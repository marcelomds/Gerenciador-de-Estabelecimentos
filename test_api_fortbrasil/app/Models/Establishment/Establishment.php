<?php

namespace App\Models\Establishment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Establishment extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'fantasy_name',
        'document',
        'phone',
        'email',
        'street',
        'number',
        'neighborhood',
        'complement',
        'state',
        'city',
        'zipcode'
    ];
}
