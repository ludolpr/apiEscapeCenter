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
    public function store(Request $request, EgCategory $categoryEg)
    {
        $request->validate([
            'name_category_eg' => 'required|max:50',
            'description_category_eg' => 'required|max:400',
        ]);

        $categoryEg = EgCategory::create([
            'name_category_eg' => $request->name_category_eg,
            'description_category_eg' => $request->description_category_eg
        ]);

        return response()->json([
            'status' => 'Success',
            'data' => $categoryEg,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(EgCategory $categoryEg)
    {
        return response()->json($categoryEg);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EgCategory $categoryEg)
    {
        $request->validate([
            'name_category_eg' => 'required|max:50',
            'description_category_eg' => 'required|max:400',
        ]);

        $categoryEg->update($request->all());

        return response()->json([
            "status" => "Mise à jour avec succèss",
            "data" => $categoryEg
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EgCategory $categoryEg)
    {
        $categoryEg->delete();

        return response()->json([
            'status' => 'Delete OK',
        ]);
    }
}
