<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blog = Blog::all();
        return response()->json($blog);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Blog $blog)
    {
        $request->validate([
            'name_blog' => 'required|max:50',
            'picture_blog' => 'required|max:255',
            'description_blog' => 'required|max:400',
            'id_user' => 'required|max:50'
        ]);

        $filename = "";
        if ($request->hasFile('picture_blog')) {
            $filenameWithExt = $request->file('picture_blog')->getClientOriginalName();
            $filenameWithExt = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('picture_blog')->getClientOriginalExtension();
            $filename = $filenameWithExt . '_' . time() . '.' . $extension;
            $request->file('picture_blog')->storeAs('public/uploads/blogs', $filename);
        } else {
            $filename = Null;
        }

        $blog = Blog::create([
            'name_blog' => $request->name_blog,
            'picture_blog' => $filename,
            'description_blog' => $request->description_blog,
            'id_user' => $request->id_user
        ]);

        return response()->json([
            'status' => 'Success',
            'data' => $blog,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return response()->json($blog);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'name_blog' => 'required|max:50',
            'picture_blog' => 'required|max:255',
            'description_blog' => 'required|max:400',
        ]);

        $blog->update($request->all());

        return response()->json([
            "status" => "Mise à jour avec succèss",
            "data" => $blog
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();

        return response()->json([
            'status' => 'Delete OK',
        ]);
    }
}