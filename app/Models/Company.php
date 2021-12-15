<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'url', 
        'software_skils', 
        'email', 
        'postal_code', 
        'street',
        'address_number',
        'province',
        'latitude',
        'longitude',
        'blacklisted'
    ];

    public $timestamps = false;

    public function tag()
    {
        return $this->hasMany(Tag::class, 'companie_id');
    }
}
