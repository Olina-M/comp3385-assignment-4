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
                "poster" => $movie->poster
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
        $validator = $request->validate(
            [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'poster' => 'required|image', 
            ]
        );
        
        $posterPath = $request->file('poster')->storeAs('posters', $request->file('poster')->getClientOriginalName(), 'public');

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
