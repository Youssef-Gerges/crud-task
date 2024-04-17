@extends('layout')
@section('content')
    <div class="d-flex items-center flex-column">

        @if(session()->has('message'))
        <div class="alert alert-primary mt-5">
           {{session()->get('message')}}
          </div>
        @endif
        <a href="{{ route('articles.create') }}" class="btn btn-block  m-4 btn-primary">Create</a>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articles as $article)

                <tr>
                    <th scope="row">{{ $loop->index + 1 }}</th>
                    <td><a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a></td>
                    <td>
                        <a href="{{ route('articles.edit', $article) }}" class="btn btn-info">Edit</a>
                        <form method="POST" action="{{ route('articles.destroy', $article) }}" class="d-inline">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>

    </div>

@endsection
