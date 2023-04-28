<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Genre;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::all();
        return view('movies.index', compact('movies'));
    }

    public function create()
    {
        $genres = Genre::all();
        return view('movies.create', compact('genres'));
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'director' => 'required|string|max:255',
            'synopsis' => 'required|string',
            'genres' => 'required|array', // Validar que se envíe un arreglo de géneros
            'genres.*' => 'exists:genres,id' // Validar que los IDs de géneros existan en la base de datos
        ]);
    
        // Crear la película y guardarla en la base de datos
        $movie = Movie::create([
            'title' => $validatedData['title'],
            'director' => $validatedData['director'],
            'synopsis' => $validatedData['synopsis']
        ]);
    
        // Agregar los géneros a la película
        $movie->genres()->attach($validatedData['genres']);
    
        // Redireccionar a la página de detalles de la película o a otra página según tus necesidades
        return redirect()->route('movies.show', $movie);
    }

    public function show(Movie $movie)
    {
        return view('movies.show', compact('movie'));
    }

    public function edit(Movie $movie)
    {   $genres = Genre::all();
        return view('movies.edit', compact('movie'),compact('genres'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'director' => 'required|string|max:255',
            'synopsis' => 'required|string',
            'genres' => 'array', // Validar que se envíe un arreglo de géneros
            'genres.*' => 'exists:genres,id' // Validar que los IDs de géneros existan en la base de datos
        ]);
    
        $movie = Movie::find($id);
    
        if (!$movie) {
            return response()->json(['message' => 'Movie not found'], 404);
        };
    
        $movie->title = $validatedData['title'];
        $movie->director = $validatedData['director'];
        $movie->synopsis = $validatedData['synopsis'];
        if (array_key_exists('genres', $validatedData)) {
            $movie->genres()->sync($validatedData['genres']);
        } else {
            $movie->genres()->detach();
        }
    
        $movie->save();
    
        return redirect()->route('movies.show', $movie);
    }

    public function destroy(Movie $movie)
    {
        $movie->delete();

        return redirect()->route('movies.index');
    }
}
