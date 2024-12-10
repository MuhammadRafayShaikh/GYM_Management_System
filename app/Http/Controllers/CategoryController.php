<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::all();

        return response()->json([
            'status' => true,
            'message' => 'All Categories Data',
            'categories' => $category
        ], 200);
    }

    public function categoryPDF()
    {
        $category = Category::all();

        $pdf = Pdf::loadView('pdf.categoryPDF', compact('category'));

        return $pdf->download('category.pdf');
    }

    public function category()
    {
        return view('category');
    }

    public function create()
    {
        return view('add-category');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $categoryValidation = validator($request->all(), [
            'category_name' => 'required',
            'category_description' => 'required'
        ]);

        if ($categoryValidation->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Failed',
                'error' => $categoryValidation->errors()->all()
            ], 401);
        }

        $category = Category::create([
            'category_name' => $request->category_name,
            'category_description' => $request->category_description,
        ]);

        if ($category) {
            return response()->json([
                'status' => true,
                'message' => 'Category Added',
                'categories' => $category
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Category Not Added'
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);

        return response()->json([
            'status' => true,
            'message' => 'Single Category',
            'category' => $category
        ], 200);
    }

    public function edit(string $id)
    {
        $category = Category::find($id);
        return view('update-category', compact('category'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $categoryValidation = validator([
            'category_name' => 'required',
            'category_description' => 'required|max:255'
        ]);

        if ($categoryValidation->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Failed',
                'error' => $categoryValidation->errors()->all()
            ], 401);
        }

        $category = Category::find($id);

        $category->update([
            'category_name' => $request->category_name,
            'category_description' => $request->category_description,
        ]);

        if ($category) {
            return response()->json([
                'status' => true,
                'message' => 'Category Updated',
                'categories' => $category
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Category Not Updated'
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
