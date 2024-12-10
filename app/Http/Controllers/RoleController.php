<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();

        return response()->json([
            'status' => true,
            'message' => 'All Roles',
            'roles' => $roles
        ], 200);
    }
    public function role()
    {
        return view('role');
    }

    public function create()
    {
        return view('add-role');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $roleValidation = validator($request->all(), [
            'name' => 'required',
            'description' => 'required|max:255'
        ]);

        if ($roleValidation->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Failed',
                'error' => $roleValidation->errors()->all()
            ], 401);
        }

        $role = Role::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        if ($role) {
            return response()->json([
                'status' => true,
                'message' => 'Role Added',
                'categories' => $role
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Role Not Added'
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $role = Role::find($id);
        return view('update-role', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $roleValidation = validator($request->all(), [
            'name' => 'required',
            'description' => 'required|max:255'
        ]);

        if ($roleValidation->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Failed',
                'error' => $roleValidation->errors()->all()
            ], 401);
        }

        $role = Role::find($id);

        $role->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        if ($role) {
            return response()->json([
                'status' => true,
                'message' => 'Role Updated',
                'categories' => $role
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Role Not Updated'
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
