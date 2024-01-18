<?php

namespace Skacharya\LaravelRbac\Controllers;

use Illuminate\Http\Request;
use Skacharya\LaravelRbac\Controllers\Controller;
use Skacharya\LaravelRbac\Models\Access;
use Skacharya\LaravelRbac\Models\RbacRoute;
use Skacharya\LaravelRbac\Models\RoleAccess;
use Skacharya\LaravelRbac\Models\Role;


class AccessController extends Controller
{
    /**
     * Display a listing of roles.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = RbacRoute::all();
        return response()->json(["message" => "success", "flag" => true, "data" => $roles]);
    }

    public function withRole(Role $role)
    {
        $access = RoleAccess::where(["role_id" => $role->id])->get();
        return response()->json(["message" => "success", "flag" => true, "data" => $access, "role" => $role]);
    }

    /**
     * Store a newly created role in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'role_id' => 'required',
            'access_id' => 'required'
            // Other validation rules as needed
        ]);

        RoleAccess::where(['role_id' => $request->role_id, 'access_id' => $request->access_id])->delete();
        RoleAccess::create(['role_id' => $request->role_id, 'access_id' => $request->access_id]);

        return response()->json(["message" => "success", "flag" => true]);
    }

    /**
     * Remove the specified role from storage.
     *
     * @param  \YourVendorName\YourPluginName\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(RoleAccess $role_access) // Use route model binding
    {
        $role_access->delete();
        return response()->json(["message" => "success", "flag" => true]);
    }
}
