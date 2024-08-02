<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\EscapeGame;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EscapeGameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $escape = EscapeGame::all();
        return response()->json($escape);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, EscapeGame $escape)
    {
        $request->validate([
            'name_escape' => 'required|max:50',
            'description_escape' => 'required|max:400',
            'picture_escape' => 'required|image|max:5000',
            'address_escape' => 'required|max:155',
            'town_escape' => 'required|max:100',
            'zipcode_escape' => 'required|max:5',
            'lat_escape' => 'required|max:100',
            'long_escape' => 'required|max:100',
            'id_category_eg' => 'required',
        ]);

        $filename = "";
        if ($request->hasFile('picture_escape')) {
            $filenameWithExt = $request->file('picture_escape')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('picture_escape')->getClientOriginalExtension();
            $filename = $filename . '_' . time() . '.' . $extension;
            $request->file('picture_escape')->storeAs('public/uploads/escapes', $filename);
        }

        $escape = EscapeGame::create([
            'name_escape' => $request->name_escape,
            'description_escape' => $request->description_escape,
            'picture_escape' => $filename,
            'address_escape' => $request->address_escape,
            'town_escape' => $request->town_escape,
            'zipcode_escape' => $request->zipcode_escape,
            'lat_escape' => $request->lat_escape,
            'long_escape' => $request->long_escape,
            'id_category_eg' => $request->id_category_eg,
        ]);

        $arounds = $request->arounds;
        $escape->arounds()->attach($arounds);

        return response()->json([
            'status' => 'Success',
            'data' => $escape,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(EscapeGame $escape)
    {
        return response()->json($escape);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EscapeGame $escape)
    {
        $request->validate([
            'name_escape' => 'required|string|max:50',
            'description_escape' => 'required|string|max:400',
            'picture_escape' => 'sometimes|image|max:5000',
            'address_escape' => 'required|max:155',
            'town_escape' => 'required|string|max:100',
            'zipcode_escape' => 'required|max:5',
            'lat_escape' => 'required|max:100',
            'long_escape' => 'required|max:100',
            'id_category_eg' => 'required|integer'
        ]);

        if ($request->hasFile('picture_escape')) {
            // Delete old file
            if ($escape->picture_escape) {
                Storage::delete('public/uploads/escapes/' . $escape->picture_escape);
            }

            $filenameWithExt = $request->file('picture_escape')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('picture_escape')->getClientOriginalExtension();
            $filename = $filename . '_' . time() . '.' . $extension;
            $request->file('picture_escape')->storeAs('public/uploads/escapes', $filename);

            $escape->picture_escape = $filename;
        }

        $escape->update($request->except('picture_escape'));

        $arounds = $request->arounds;
        $escape->arounds()->sync($arounds);

        return response()->json([
            "status" => "Mise à jour avec succès",
            "data" => $escape,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EscapeGame $escape)
    {
        if ($escape->picture_escape) {
            Storage::delete('public/uploads/escapes/' . $escape->picture_escape);
        }

        $escape->delete();

        return response()->json([
            'status' => 'Delete OK',
        ]);
    }
}