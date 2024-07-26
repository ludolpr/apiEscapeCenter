<?php

namespace App\Http\Controllers\API;

use App\Models\EgCategory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EgCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categoryEg = EgCategory::all();
        return response()->json($categoryEg);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, EgCategory $categoryeg)
    {
        $request->validate([
            'name_category_eg' => 'required|max:50',
            'description_category_eg' => 'required|max:400',
        ]);

        $categoryeg = EgCategory::create([
            'name_category_eg' => $request->name_category_eg,
            'description_category_eg' => $request->description_category_eg
        ]);

        return response()->json([
            'status' => 'Success',
            'data' => $categoryeg,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(EgCategory $categoryeg)
    {
        return response()->json($categoryeg);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EgCategory $categoryeg)
    {
        $request->validate([
            'name_category_eg' => 'required|max:50',
            'description_category_eg' => 'required|max:400',
        ]);

        $categoryeg->update($request->all());

        return response()->json([
            "status" => "Mise à jour avec succèss",
            "data" => $categoryeg
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EgCategory $categoryeg)
    {
        $categoryeg->delete();

        return response()->json([
            'status' => 'Delete OK',
        ]);
    }
}