<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'forget_password_token', 'image', 'status', 'admin_type', 'slug', 'about_us',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @param $query
     * @return mixed
     */
    public function scopeNotSuperAdmin($query)
    {
        return $query->where('is_super_admin', 0);
    }

    /**
     * @return mixed
     */
    public static function getPermissionGroup()
    {
        $permission_group = DB::table('permissions')
            ->select('group_name as name')->orderBy('group_name')
            ->groupBy('group_name')
            ->get();

        return $permission_group;
    }

    /**
     * @param $group_name
     * @return mixed
     */
    public static function getpermissionsByGroupName($group_name)
    {
        $permissions = DB::table('permissions')
            ->select('name', 'id')
            ->where('group_name', $group_name)
            ->get();

        return $permissions;
    }

    public static function getPermissionGroupsWithPermissions()
    {
        return DB::table('permissions')
            ->select('group_name', 'id', 'name')
            ->orderBy('group_name')
            ->get()
            ->groupBy('group_name');
    }

    /**
     * @param $role
     * @param $permissions
     * @return mixed
     */
    public static function roleHasPermission($role, $permissions)
    {
        $hasPermission = true;
        foreach ($permissions as $permission) {
            if (!$role->hasPermissionTo($permission->name)) {
                $hasPermission = false;

                return $hasPermission;
            }
        }

        return $hasPermission;
    }
}
