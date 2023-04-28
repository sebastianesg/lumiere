@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Lumiere</div>

                <div class="card-body">
                @guest
                        <p>No inicio sesión. Por favor <a href="{{ route('login') }}">Inicie sesión</a> para continuar.</p>
                    @else
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ route('movies.index') }}" class="btn btn-primary btn-block">Películas</a>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('genres.index') }}" class="btn btn-primary btn-block">Generos</a>
                            </div>
                            <div class="col-md-6 mt-3">
                                <a href="{{ route('movies.create') }}" class="btn btn-success btn-block">Crear Pelicula</a>
                            </div>
                            <div class="col-md-6 mt-3">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-block">Logout</button>
                                </form>
                            </div>
                        </div>
                    @endguest
                    <hr>
                    <h3 class="mb-3">Recent Movies</h3>
                    <div class="row">
                        @foreach ($movies as $movie)
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $movie->title }}</h5>
                                    <p class="card-text">{{ Str::limit($movie->synopsis, 50) }}</p>
                                    <a href="{{ route('movies.show', $movie->id) }}" class="btn btn-primary">Detalle</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
