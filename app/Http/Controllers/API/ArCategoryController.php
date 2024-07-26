<?php

namespace App\Http\Controllers\API;

use App\Models\ArCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categoryar = ArCategory::all();
        return response()->json($categoryar);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, ArCategory $categoryar)
    {
        $request->validate([
            'name_category_ar' => 'required|max:50',
            'description_category_ar' => 'required|max:400',
        ]);

        $categoryar = ArCategory::create([
            'name_category_ar' => $request->name_category_ar,
            'description_category_ar' => $request->description_category_ar
        ]);

        return response()->json([
            'status' => 'Success',
            'data' => $categoryar,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(ArCategory $categoryar)
    {
        return response()->json($categoryar);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ArCategory $categoryar)
    {
        $request->validate([
            'name_category_ar' => 'required|max:50',
            'description_category_ar' => 'required|max:400',
        ]);

        $categoryar->update($request->all());

        return response()->json([
            "status" => "Mise à jour avec succèss",
            "data" => $categoryar
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ArCategory $categoryar)
    {
        $categoryar->delete();

        return response()->json([
            'status' => 'Delete OK',
        ]);
    }
}