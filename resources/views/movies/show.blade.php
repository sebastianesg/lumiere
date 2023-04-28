@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12">
                <div class="row">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-8">
                        <h2 class="font-weight-bold">{{ $movie->title }}</h2>
                        <h5 class="font-italic">{{ $movie->director }}</h5>
                        <p class="mt-4">{{ $movie->synopsis }}</p>
                        <div class="mt-5">
                            <h6 class="font-weight-bold mb-3">Géneros:</h6>
                            <ul class="list-inline">
                                @foreach ($movie->genres as $genre)
                                    <li class="list-inline-item">{{ $genre->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
