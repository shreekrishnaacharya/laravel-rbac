<?php

namespace Sk\LaravelRbac\Controllers;

use Illuminate\Http\Request;
use Sk\LaravelRbac\Controllers\Controller;
use Sk\LaravelRbac\Models\Role;

class RoleController extends Controller
{

    /**
     * Display a listing of roles.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return view("laravel-rbac::index");
    }

    public function users()
    {
        $users = config("skrbac.user_model")::select(["name", "id"])->get();
        return response()->json(["message" => "success", "flag" => true, "data" => $users]);
    }
    /**
     * Display a listing of roles.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::with("users:id,name")->get();
        return response()->json(["message" => "success", "flag" => true, "data" => $roles]);
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
            'name' => 'required|unique:skrbac_roles,name',
            'users' => 'required'
            // Other validation rules as needed
        ]);
        try {
            $role = Role::create($request->all());
            // Assign permissions if applicable
            $role->users()->sync($request->users);
            return response()->json(["message" => "success", "flag" => true]);
        } catch (\Exception $ex) {
        }

        return response()->json(["message" => "error", "flag" => false]);
    }

    /**
     * Display the specified role.
     *
     * @param  \YourVendorName\YourPluginName\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role) // Use route model binding
    {
        $role["users"] = $role->users()->get()->pluck("id");
        return response()->json(["message" => "success", "flag" => true, "data" => $role]);
    }

    /**
     * Update the specified role in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \YourVendorName\YourPluginName\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role) // Use route model binding
    {
        $this->validate($request, [
            'name' => 'required|unique:skrbac_roles,name,' . $role->id, // Ensure uniqueness
            'users' => 'required'
            // Other validation rules as needed
        ]);

        try {
            $role->update($request->all());

            // Update permissions if applicable
            $role->users()->sync($request->users);

            return response()->json(["message" => "success", "flag" => true]);
        } catch (\Exception $ex) {
            dd($ex->getMessage());
        }

        return response()->json(["message" => "error", "flag" => false]);
    }

    /**
     * Remove the specified role from storage.
     *
     * @param  \YourVendorName\YourPluginName\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role) // Use route model binding
    {
        $role->delete();
        return response()->json(["message" => "success", "flag" => true]);
    }
}
