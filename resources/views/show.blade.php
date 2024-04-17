@extends('layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="row mt-4">
                <div>

                    <a href="{{ route('articles.edit', $article) }}" class="btn btn-info w-fit">Edit</a>
                    <form method="POST" action="{{ route('articles.destroy', $article) }}" class="d-inline">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
                </div>
            <h1 class="mt-5">Article ID: {{ $article->id }}</h1>
            <h2>Title: {{ $article->title }}</h2>
            <h2>Images:</h2>

            <div class=" row">
                @foreach ($article->images as $image)
                    <div class="col-4 p-5">
                        <img style="width: 250px; object-fit: cover" src="{{ Storage::url($image->path) }}" alt="{{ $image->id }}">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
