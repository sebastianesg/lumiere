@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Genres</div>
                <div class="card-body">
                <div class="col-md-6">
                                <a href="{{ route('genres.create') }}" class="btn btn-primary btn-block">Create Genre</a>
                </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($genres as $genre)
                            <tr>
                                <td>{{ $genre->name }}</td>
                                <td>
                                    <form action="{{ route('genres.destroy', $genre->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar este genero?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
