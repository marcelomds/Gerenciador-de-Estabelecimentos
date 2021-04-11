<?php

namespace App\Models\Establishment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Establishment extends Model
{
    use HasFactory, SoftDeletes;

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
