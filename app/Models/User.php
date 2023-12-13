<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Encore\Admin\Auth\Database\Administrator;
use DB;
use App\Models\AdminRole;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Models\CooperativeMember;




class User extends Authenticatable implements JWTSubject
{

    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'admin_users';

    public static function getAgents()
    {
        return User::whereHas('roles', function ($query) {
            $query->where('slug', 'agent');
        })->get();
    }

    public function assignRole(String $role, bool $clearPrevious = true)
    {
        $role = AdminRole::where('slug', $role)->first();

        if ($clearPrevious) {
            DB::table('admin_role_users')->where('user_id', $this->id)->delete();
        }
        DB::table('admin_role_users')->insert([
            'role_id' => $role->id,
            'user_id' => $this->id
        ]);
    }

    // public function hasRole(String $role) 
    // {
    //     $role = AdminRole::where('slug', $role)->first();
    //     return DB::table('admin_role_users')->where([
    //         'role_id' => $role->id,
    //         'user_id' => $this->id
    //     ])->exists();

    // }

    public function farmersInspected()
    {
        return $this->hasMany(Farmer::class, 'agent_id');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

}
