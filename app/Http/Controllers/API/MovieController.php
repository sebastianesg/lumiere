<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Movie;
use App\Models\Genre;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::with('genres')->get();
        foreach ($movies as $movie) {
            $movie->genres->makeHidden('pivot');
        }
        return response()->json($movies, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'director' => 'required|max:255',
            'synopsis' => 'nullable',
            'genres.*' => 'exists:genres,id' // Validar que los IDs de géneros existan en la base de datos
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $movie = new Movie();
        $movie->title = $request->input('title');
        $movie->director = $request->input('director');
        $movie->synopsis = $request->input('synopsis');
        $genres = json_decode($request->input('genres'));
        $movie->save();
        foreach ($genres as $name) {
            $genre = Genre::where('name', $name)->first();
            $movie->genres()->attach($genre);
            }
        return response()->json($movie, 201);
    }

    public function show($id)
    {
        $movie = Movie::find($id);

        if ($movie) {
            return response()->json($movie, 200);
        } else {
            return response()->json(['message' => 'Movie not found'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'director' => 'required|max:255',
            'synopsis' => 'nullable'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $movie = Movie::find($id);
        if ($movie) {
            $movie->title = $request->input('title');
            $movie->director = $request->input('director');
            $movie->synopsis = $request->input('synopsis');
            $movie->save();
            $genres = json_decode($request->input('genres'));
            $genreErrors=[];
            foreach ($genres as $name) {
                $genre = Genre::where('name', $name)->first();
                if (!$genre) {
                    array_push($genreErrors,$name);
                }else{
                    $movie->genres()->attach($genre);
                }
            }
            if (empty($genreErrors)) {
                return response()->json($movie, 200);
            } else {
                return response()->json(['message' => 'Se grabo la pelicula sin asignar los siguientes generos '. implode(", ", $genre)], 110);
            }
        } else {
            return response()->json(['message' => 'Movie not found'], 404);
        }
    }

    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
    
        if ($movie->delete()) {
            return response()->json(['message' => 'Movie deleted'], 200);
        } else {
            return response()->json(['message' => 'Error deleting movie'], 500);
        }
    }
}  
       
