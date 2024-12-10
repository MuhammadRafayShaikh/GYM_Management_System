<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Role;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groups = Group::all();

        return response()->json([
            'status' => true,
            'message' => 'All Groups',
            'groups' => $groups
        ], 200);
    }
    public function group()
    {
        return view('group');
    }

    public function create()
    {
        return view('add-group');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $groupValidation = validator($request->all(), [
            'name' => 'required',
            'description' => 'required|max:255'
        ]);

        if ($groupValidation->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Failed',
                'error' => $groupValidation->errors()->all()
            ], 401);
        }

        $group = Group::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        if ($group) {
            return response()->json([
                'status' => true,
                'message' => 'Group Added',
                'group' => $group
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Group Not Added'
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
        $group = Group::find($id);
        return view('update-group', compact('group'));
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

        $group = Group::find($id);

        $group->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        if ($group) {
            return response()->json([
                'status' => true,
                'message' => 'Group Updated',
                'categories' => $group
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Group Not Updated'
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
