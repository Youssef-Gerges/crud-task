@extends('layout')
@section('content')
    <div class="row">
        <div class="col-12">

            <h1 class="mt-5">Create Article</h1>
            <form method="POST" enctype="multipart/form-data" action="{{ route('articles.store') }}">
                @csrf
                <div class="form-group row my-5">
                    <label for="title">Title</label>
                    <input name="title" type="text" max="255" value="{{ old('title') }}" required
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
        </div>
    </div>
@endsection
