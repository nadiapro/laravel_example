<?php

namespace App\Models;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];
    use HasFactory;

    public function profiles()
    {
        return $this->hasMany(Profile::class);
    }
}
