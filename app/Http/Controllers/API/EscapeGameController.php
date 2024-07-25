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
        $escapeGame = EscapeGame::all();
        return response()->json($escapeGame);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, EscapeGame $escapeGame)
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
            'id_category_eg' => 'required'

        ]);

        $escapeGame = EscapeGame::create([
            'name_escape' => $request->name_escape,
            'description_escape' => $request->description_escape,
            'picture_escape' => $request->picture_escape,
            'address_escape' => $request->address_escape,
            'town_escape' => $request->town_escape,
            'zipcode_escape' => $request->zipcode_escape,
            'lat_escape' => $request->lat_escape,
            'long_escape' => $request->long_escape,
            'id_category_eg' => $request->id_category_eg

        ]);

        return response()->json([
            'status' => 'Success',
            'data' => $escapeGame,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(EscapeGame $escapeGame)
    {
        return response()->json($escapeGame);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EscapeGame $escapeGame)
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
            'id_category_eg' => 'required'
        ]);

        $escapeGame = EscapeGame::create([
            'name_escape' => $request->name_escape,
            'description_escape' => $request->description_escape,
            'picture_escape' => $request->picture_escape,
            'address_escape' => $request->address_escape,
            'town_escape' => $request->town_escape,
            'zipcode_escape' => $request->zipcode_escape,
            'lat_escape' => $request->lat_escape,
            'long_escape' => $request->long_escape,
            'id_category_eg' => $request->id_category_eg

        ]);

        return response()->json([
            "status" => "Mise à jour avec succèss",
            "data" => $escapeGame,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    
    public function destroy(EscapeGame $escapeGame)
    {
        $escapeGame->delete();

        return response()->json([
            'status' => 'Delete OK',
        ]);
    }
}