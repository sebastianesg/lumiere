<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Movie;
use App\Models\Genre;

class MoviesTableSeeder extends Seeder
{
    public function run()
    {
        $genres = Genre::all();

        $movies = [
            [
                'title' => 'El Padrino',
                'director' => 'Francis Ford Coppola',
                'synopsis' => 'Don Vito Corleone, conocido dentro de los círculos del hampa como "El Padrino", es el patriarca de una de las cinco familias que ejercen el mando de la Cosa Nostra en Nueva York en los años 40. Don Corleone tiene cuatro hijos; una chica, Connie, y tres varones, Santino, o Sonny, como le gusta que le llamen, Michael y Freddie, al que envían exiliado a Las Vegas, dada su incapacidad para asumir puestos de mando en la "Familia". Cuando Corleone rechaza intervenir en el negocio de las drogas, el jefe de otra banda ordena su asesinato. Empieza entonces una violenta y cruenta guerra entre las familias mafiosas.',
                'genres' => [$genres->where('name', 'Drama')->first(), $genres->where('name', 'Crimen')->first()],
            ],
            [
                'title' => 'El Padrino: Parte II',
                'director' => 'Francis Ford Coppola',
                'synopsis' => 'Continuación de la saga de los Corleone con dos historias paralelas: la elección de Michael Corleone como jefe de los negocios familiares y los orígenes del patriarca, el ya fallecido Don Vito, primero en su juventud en Sicilia y posteriormente en Nueva York durante los años 20.',
                'genres' => [$genres->where('name', 'Drama')->first(), $genres->where('name', 'Crimen')->first()],
            ],
            [
                'title' => 'El bueno, el malo y el feo',
                'director' => 'Sergio Leone',
                'synopsis' => 'Durante la Guerra de Secesión, tres cazadores de recompensas se lanzan a la búsqueda de un tesoro que ninguno de los tres truhanes puede localizar sin la ayuda de los otros dos.',
                'genres' => [$genres->where('name', 'Western')->first(), $genres->where('name', 'Aventuras')->first()],
            ],
            [
                'title' => 'La vida es bella',
                'director' => 'Roberto Benigni',
                'synopsis' => 'En 1938, Guido, un soñador propietario de una librería, llega a la Toscana con la intención de abrir una nueva tienda. Allí conoce a Dora, una bella maestra de la que queda enamorado a primera vista. Juntos tienen un hijo y son muy felices hasta que estalla la Segunda Guerra Mundial y son internados en un campo de concentración nazi. Guido hará todo lo posible para proteger a su hijo de los horrores del campo y para que la vida siga siendo bella.',
                'genres' => [$genres->where('name', 'Comedia')->first(), $genres->where('name', 'Drama')->first()],
                ]
        ];

        foreach ($movies as $movieData) {
            $movie = new Movie();
            $movie->title = $movieData['title'];
            $movie->director = $movieData['director'];
            $movie->synopsis = $movieData['synopsis'];
            $movie->save();

            // Asocia los géneros a la película
            foreach ($movieData['genres'] as $genre) {
                $movie->genres()->attach($genre);
            }
        }
    }
}
