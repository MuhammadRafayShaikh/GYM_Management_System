<?php

namespace App\Http\Controllers;

use App\Models\Specialization;
use Illuminate\Http\Request;

class SpecializationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $special = Specialization::all();

        return response()->json([
            'status' => true,
            'message' => 'All Specialization Data',
            'special' => $special
        ], 200);
    }
    public function special()
    {
        return view('specialization');
    }

    public function create()
    {
        return view('add-specialization');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
        $specialValidation = validator($request->all(), [
            'name' => 'required',
            'description' => 'required'
        ]);

        if ($specialValidation->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Failed',
                'error' => $specialValidation->errors()->all()
            ], 401);
        }

        $special = Specialization::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        if ($special) {
            return response()->json([
                'status' => true,
                'message' => 'Special Added',
                'categories' => $special
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Special Not Added'
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
        $special = Specialization::find($id);
        return view('update-specialization', compact('special'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $specialValidation = validator($request->all(), [
            'name' => 'required',
            'description' => 'required'
        ]);

        if ($specialValidation->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Failed',
                'error' => $specialValidation->errors()->all()
            ], 401);
        }

        $special = Specialization::find($id);

        $special->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        if ($special) {
            return response()->json([
                'status' => true,
                'message' => 'Special Updated',
                'categories' => $special
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Special Not Updated'
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
