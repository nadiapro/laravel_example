<?php

namespace App\Models;

use App\Models\Education;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
    ];

    public function education()
    {
        return $this->hasMany(Education::class);
    }
}
