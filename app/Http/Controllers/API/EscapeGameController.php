<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\EscapeGame;
use Illuminate\Http\Request;

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
            'picture_escape' => 'required|max:255',
            'address_escape' => 'required|max:155',
            'town_escape' => 'required|max:100',
            'zipcode_escape' => 'required|max:5',
            'lat_escape' => 'required|max:100',
            'long_escape' => 'required|max:100',
            'id_category_eg' => 'required',

        ]);
        $escape = EscapeGame::create([
            'name_escape' => $request->name_escape,
            'description_escape' => $request->description_escape,
            'picture_escape' => $request->picture_escape,
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
            'picture_escape' => 'required|image',
            'address_escape' => 'required|max:155',
            'town_escape' => 'required|string|max:100',
            'zipcode_escape' => 'required|max:5',
            'lat_escape' => 'required|max:100',
            'long_escape' => 'required|max:100',
            'id_category_eg' => 'required|integer'
        ]);


        $escape->update($request->all());

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
        $escape->delete();

        return response()->json([
            'status' => 'Delete OK',
        ]);
    }
}