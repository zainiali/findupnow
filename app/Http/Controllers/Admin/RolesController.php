<?php

namespace App\Http\Controllers\Admin;

use App\Enums\RedirectType;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleFormRequest;
use App\Models\Admin;
use App\Traits\RedirectHelperTrait;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    use RedirectHelperTrait;

    /**
     * @return mixed
     */
    public function index()
    {
        checkAdminHasPermissionAndThrowException('role.view');

        $roles         = Role::with('permissions')->paginate(15);
        $admins_exists = Admin::whereStatus('active')->count();

        return view('admin.roles.index', compact('roles', 'admins_exists'));
    }

    public function create()
    {
        checkAdminHasPermissionAndThrowException('role.create');
        $permissions       = Permission::all();
        $permission_groups = Admin::getPermissionGroupsWithPermissions();

        return view('admin.roles.create', compact('permissions', 'permission_groups'));
    }

    /**
     * @param  RoleFormRequest $request
     * @return mixed
     */
    public function store(RoleFormRequest $request)
    {
        checkAdminHasPermissionAndThrowException('role.store');
        $role = Role::create(['name' => $request->name]);
        if (!empty($request->permissions)) {
            $role->syncPermissions($request->permissions);
        }

        return $this->redirectWithMessage(RedirectType::CREATE->value, 'admin.role.index');
    }

    /**
     * @param $id
     */
    public function edit($id)
    {
        checkAdminHasPermissionAndThrowException('role.edit');
        $role = Role::where('name', '!=', 'Super Admin')->where('id', $id)->first();
        abort_if(!$role, 403);
        $permissions       = Permission::all();
        $permission_groups = Admin::getPermissionGroupsWithPermissions();

        return view('admin.roles.edit', compact('permissions', 'permission_groups', 'role'));
    }

    /**
     * @param  RoleFormRequest $request
     * @param  $id
     * @return mixed
     */
    public function update(RoleFormRequest $request, $id)
    {
        checkAdminHasPermissionAndThrowException('role.update');
        $role = Role::where('name', '!=', 'Super Admin')->where('id', $id)->first();
        abort_if(!$role, 403);
        if (!empty($request->permissions)) {
            $role->name = $request->name;
            $role->save();
            $role->syncPermissions($request->permissions);
        }

        return $this->redirectWithMessage(RedirectType::UPDATE->value, 'admin.role.index');
    }

    /**
     * @param  $id
     * @return mixed
     */
    public function destroy($id)
    {
        checkAdminHasPermissionAndThrowException('role.delete');
        $role = Role::where('name', '!=', 'Super Admin')->where('id', $id)->first();
        abort_if(!$role, 403);
        if (!is_null($role)) {
            $role->delete();
        }

        return $this->redirectWithMessage(RedirectType::DELETE->value, 'admin.role.index');
    }

    public function assignRoleView()
    {
        checkAdminHasPermissionAndThrowException('role.assign');
        $admins = Admin::whereStatus('active')->get();
        $roles  = Role::where('name', '!=', 'Super Admin')->get();

        return view('admin.roles.assign-role', compact('admins', 'roles'));
    }

    /**
     * @param $id
     */
    public function getAdminRoles($id)
    {
        $admin   = Admin::find($id);
        $options = "<option value='' disabled>" . __('Select Role') . '</option>';
        if ($admin) {
            $roles = Role::where('name', '!=', 'Super Admin')->get();
            foreach ($roles as $role) {
                $options .= "<option value='{$role->name}' " . ($admin->hasRole($role->name) ? 'selected' : '') . ">{$role->name}</option>";
            }

            return response()->json([
                'success' => true,
                'data'    => $options,
            ]);
        }

        return response()->json([
            'success' => false,
            'data'    => $options,
        ]);
    }

    /**
     * @param  Request $request
     * @return mixed
     */
    public function assignRoleUpdate(Request $request)
    {
        checkAdminHasPermissionAndThrowException('role.assign');

        $messages = [
            'user_id.required' => __('You must select an admin'),
            'user_id.exists'   => __('Admin not found'),
            'role.required'    => __('You must select role'),
            'role.array'       => __('You must select role'),
            'role.*.required'  => __('You must select role'),
            'role.*.string'    => __('You must select role'),
        ];

        $request->validate([
            'user_id' => 'required|exists:admins,id',
            'role'    => 'required|array',
            'role.*'  => 'required|string',
        ], $messages);

        Admin::findOrFail($request->user_id)?->syncRoles($request->role);

        return $this->redirectWithMessage(RedirectType::UPDATE->value, 'admin.role.index');
    }
}
