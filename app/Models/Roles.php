<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;
    protected $table = 'roles';
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'name',
    ];
    public function hasRole($role)
    {
        if( $this->roles()->where('name', $role)->first())
        {
            return true;
        }
        return false;
    }

    public function hasAnyRole($roles)
    {
        if (is_array($roles))
        {
            foreach ($roles as $role)
            {
                if ($this->hasRole($role))
                {
                    return true;
                }
            }
        }else
            {
                if ($this->hasRole($roles))
                {
                    return true;
                }
            }
        return false;
    }

    public function authorizeRoles($roles)
    {
        if ($this->hasAnyRole($roles))
        {
            return true;
        }
        abort(403, 'Unauthorized Action');
    }

    protected function user()
    {
        return $this->hasMany(User::class);
    }



}
