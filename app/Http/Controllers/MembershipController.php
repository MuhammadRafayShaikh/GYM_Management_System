<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Membership;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $memeberships = Membership::with('category')->get();

        return response()->json([
            'status' => true,
            'message' => 'All Memberships',
            'memberships' => $memeberships
        ], 200);
    }
    public function membership()
    {
        return view('membership');
    }
    public function create()
    {
        $category = Category::all();
        return view('add-membership', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
        $membershipValidation = validator($request->all(), [
            'name' => 'required',
            'category_id' => 'required',
            'period' => 'required',
            'amount' => 'required',
            'description' => 'required'
        ]);

        if ($membershipValidation->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Failed',
                'error' => $membershipValidation->errors()->all()
            ], 400);
        }

        $membership = Membership::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'period' => $request->period,
            'amount' => $request->amount,
            'description' => $request->description
        ]);

        if ($membership) {
            return response()->json([
                'status' => true,
                'message' => 'Membership Added Successfully',
                'membership' => $membership
            ], 200);
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
        $membership = Membership::find($id);
        $category = Category::all();
        return view('update-membership', compact('membership', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $membershipValidation = validator($request->all(), [
            'name' => 'required',
            'category_id' => 'required|numeric',
            'period' => 'required|numeric',
            'amount' => 'required|numeric',
            'description' => 'required|max:255',
        ]);

        if ($membershipValidation->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Failed',
                'error' => $membershipValidation->errors()->all(),
            ], 400);
        }

        $membership = Membership::find($id);

        $membership->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'period' => $request->period,
            'amount' => $request->amount,
            'description' => $request->description,
        ]);

        if ($membership) {
            return response()->json([
                'status' => true,
                'message' => 'Membership Updated Successfully',
                'membership' => $membership
            ], 200);
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
