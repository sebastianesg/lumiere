@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12">
                <h1 class="mb-4">Listado de películas</h1>
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Título</th>
                            <th scope="col">Director</th>
                            <th scope="col">Sinopsis</th>
                            <th scope="col">Géneros</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($movies as $movie)
                            <tr>
                                <th scope="row">{{ $movie->id }}</th>
                                <td>{{ $movie->title }}</td>
                                <td>{{ $movie->director }}</td>
                                <td>{{ $movie->synopsis }}</td>
                                <td>
                                    @foreach ($movie->genres as $genre)
                                        <span class="badge-secondary">{{ $genre->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{ route('movies.show', $movie->id) }}" class="btn btn-sm btn-outline-info">Ver</a>
                                    <a href="{{ route('movies.edit', $movie->id) }}" class="btn btn-sm btn-outline-warning">Editar</a>
                                    <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar esta película?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">No hay películas registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-4">
                    @if ($movies instanceof \Illuminate\Pagination\LengthAwarePaginator)
                        {{ $movies->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
