@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center my-4">Create Genre</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <form method="POST" action="{{ route('genres.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name" class="h6">Name</label>
                                <input type="text" name="name" id="name" class="form-control form-control-lg @error('name') is-invalid @enderror" placeholder="Enter genre name" value="{{ old('name') }}" required autofocus>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Create Genre</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection