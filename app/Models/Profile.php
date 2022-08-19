<?php

namespace App\Models;

use App\Models\User;
use App\Models\Province;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'gender',
        'marital_status',
        'birthday',
        'about_me',
        'minimum_salary',
        'show_profile',
        'address',
        'phone_number',
        'province_id',
    ];
   public function province(){
    return $this->belongsTo(Province::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
