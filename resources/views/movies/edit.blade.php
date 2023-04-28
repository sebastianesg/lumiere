@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Editar Película') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('movies.update', $movie->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Título') }}</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $movie->title }}" required autocomplete="title" autofocus>

                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="director" class="col-md-4 col-form-label text-md-right">{{ __('Director') }}</label>

                                <div class="col-md-6">
                                    <input id="director" type="text" class="form-control @error('director') is-invalid @enderror" name="director" value="{{ $movie->director }}" required autocomplete="director">

                                    @error('director')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="synopsis" class="col-md-4 col-form-label text-md-right">{{ __('Sinopsis') }}</label>

                                <div class="col-md-6">
                                    <textarea id="synopsis" class="form-control @error('synopsis') is-invalid @enderror" name="synopsis" required autocomplete="synopsis">{{ $movie->synopsis }}</textarea>

                                    @error('synopsis')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="genres" class="col-md-4 col-form-label text-md-right">{{ __('Géneros') }}</label>

                                <div class="col-md-6">
                                    @foreach ($genres as $genre)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="genres[]" id="genre_{{ $genre->id }}" value="{{ $genre->id }}" {{ in_array($genre->id, $movie->genres->pluck('id')->toArray()) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="genre_{{ $genre->id }}">
                                                {{ $genre->name }}
                                            </label>
                                        </div>
                                    @endforeach

                                    @error('genres')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                        {{ __('Editar Película') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
