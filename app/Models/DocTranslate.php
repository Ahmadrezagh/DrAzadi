<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocTranslate extends Model
{
    use HasFactory;
    protected $fillable = [
        'content'
    ];
    public function document()
    {
        return $this->belongsTo(Doc::class);
    }
}
