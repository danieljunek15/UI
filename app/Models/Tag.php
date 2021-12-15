<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'companie_id',
        'name'
    ];

    public $timestamps = false;

    public function companie()
    {
        return $this->belongsTo(Company::class);
    }
}
