<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Around;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AroundController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $around = Around::all();
        return response()->json($around);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Around $around)
    {
        $request->validate([
            'name_around' => 'required|max:50',
            'description_around' => 'required|max:400',
            'picture_around' => 'required|image|max:5000',
            'address_around' => 'required|max:155',
            'town_around' => 'required|max:100',
            'zipcode_around' => 'required|max:5',
            'lat_around' => 'required|max:100',
            'long_around' => 'required|max:100',
            'id_category_ar' => 'required',
        ]);

        $filename = "";
        if ($request->hasFile('picture_around')) {
            $filenameWithExt = $request->file('picture_around')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('picture_around')->getClientOriginalExtension();
            $filename = $filename . '_' . time() . '.' . $extension;
            $request->file('picture_around')->storeAs('public/uploads/around', $filename);
        }

        $around = Around::create([
            'name_around' => $request->name_around,
            'description_around' => $request->description_around,
            'picture_around' => $filename,
            'address_around' => $request->address_around,
            'town_around' => $request->town_around,
            'zipcode_around' => $request->zipcode_around,
            'lat_around' => $request->lat_around,
            'long_around' => $request->long_around,
            'id_category_ar' => $request->id_category_ar
        ]);

        $escapes = $request->escapes;
        $around->escapes()->attach($escapes);

        return response()->json([
            'status' => 'Success',
            'data' => $around,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Around $around)
    {
        return response()->json($around);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Around $around)
    {
        $request->validate([
            'name_around' => 'required|max:50',
            'description_around' => 'required|max:400',
            'picture_around' => 'sometimes|image|max:5000',
            'address_around' => 'required|max:155',
            'town_around' => 'required|max:100',
            'zipcode_around' => 'required|max:5',
            'lat_around' => 'required|max:100',
            'long_around' => 'required|max:100',
            'id_category_ar' => 'required'
        ]);

        if ($request->hasFile('picture_around')) {
            // Delete old file
            if ($around->picture_around) {
                Storage::delete('public/uploads/around/' . $around->picture_around);
            }

            $filenameWithExt = $request->file('picture_around')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('picture_around')->getClientOriginalExtension();
            $filename = $filename . '_' . time() . '.' . $extension;
            $request->file('picture_around')->storeAs('public/uploads/around', $filename);

            $around->picture_around = $filename;
        }

        $around->update($request->except('picture_around'));

        $escapes = $request->escapes;
        $around->escapes()->sync($escapes);

        return response()->json([
            "status" => "Mise à jour avec succèss",
            "data" => $around
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Around $around)
    {
        if ($around->picture_around) {
            Storage::delete('public/uploads/around/' . $around->picture_around);
        }

        $around->delete();

        return response()->json([
            'status' => 'Delete OK',
        ]);
    }
}