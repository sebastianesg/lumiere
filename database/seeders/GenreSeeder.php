<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genres = [
            'Acción',
            'Aventuras',
            'Ciencia ficción',
            'Comedia',
            'Drama',
            'Fantasía',
            'Misterio',
            'Musical',
            'Romance',
            'Terror',
            'Thriller',
            'Western',
            'Documental',
            'Animación',
            'Crimen'
        ];

        foreach ($genres as $genre) {
            Genre::create([
                'name' => $genre
            ]);
        }
    }
}
