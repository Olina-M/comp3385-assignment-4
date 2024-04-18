<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use Illuminate\Support\Facades\Validator;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::all();

        // Create an array to store movie data
        $movieData = [];
        foreach ($movies as $movie) {
            $movieData[] = [
                "id" => $movie->id,
                "title" => $movie->title,
                "description" => $movie->description,
                "poster" => "/api/v1/posters/{$movie->poster}"
            ];
        }

        // Create the response JSON
        $response = [
            "message" => "Movies retrieved successfully",
            "movies" => $movieData
        ];

        // Return the response as JSON
        return response()->json($response);
    }

    public function store(Request $request)
    {
        // Validate user input
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'poster' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        if ($validator->fails()) {
            // Return validation error messages
            return response()->json([
                "message" => "Validation failed",
                "errors" => $validator->errors()
            ], 422);
        }

        $posterPath = $request->file('poster');
        $posterPath->storeAs('posters', $posterPath->getClientOriginalName(), 'public');

        // Save movie information to the movies table
        $movie = new Movie();
        $movie->title = $request->input('title');
        $movie->description = $request->input('description');
        $movie->poster = $posterPath;
        $movie->save();

        // Create the response JSON
        $response = [
            "message" => "Movie created successfully",
            "movie" => $movie
        ];

        // Return the response as JSON
        return response()->json($response);
    }
}
