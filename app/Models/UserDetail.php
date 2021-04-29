<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;
    protected $fillable =[
        'user_id',
        'national_code',
        'city' ,
        'organization',
        'position',
        'phone',
        'mail'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
