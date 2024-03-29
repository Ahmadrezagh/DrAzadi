<?php

namespace App\Models;

use App\Services\Permission\Traits\HasPermissions;
use App\Services\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use HasFactory,HasRoles, HasPermissions;
    use SoftDeletes;
    protected $fillable = [
        'name',
        'english_name',
        'persian_name',
        'type'
    ];
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function getParent()
    {
        return $this->where('id','=',$this->parent_id)->first();
    }

    public function getChildren()
    {
        return $this->where('parent_id','=',$this->id)->get();
    }

    public function scopeParents($query)
    {
        return $query->where('parent_id',null);
    }
}
