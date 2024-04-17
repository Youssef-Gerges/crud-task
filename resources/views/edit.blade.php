@extends('layout')
@section('content')
    <div class="row">
        <div class="col-12">

            <h1 class="mt-5">Update Article ID: {{ $article->id }}</h1>
            <form method="POST" enctype="multipart/form-data" action="{{ route('articles.update', $article) }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="article_id" value="{{ $article->id }}">
                <div class="form-group row my-5">
                    <label for="title">Title</label>
                    <input name="title" type="text" max="255" value="{{ $article->title }}" required
                        class="form-control" id="title" placeholder="Enter title">
                    @error('title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group row my-5">
                    <label for="images">Images</label>
                    <input name="images[]" type="file" required multiple accept="image/*" class="form-control-file"
                        id="images">
                    @error('images')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

            <div class="mt-5 row">
                @foreach ($article->images as $image)
                    <div class="col-4 p-5">
                        <img style="width: 250px; object-fit: cover" src="{{ Storage::url($image->path) }}" alt="{{ $image->id }}">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
