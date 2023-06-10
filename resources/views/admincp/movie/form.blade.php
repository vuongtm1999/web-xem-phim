@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Manage Movie</div>
                    <div class="card-body">

                        @if (!isset($movie))
                            {!! Form::open(['route' => 'movie.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                        @else
                            {!! Form::open(['route' => ['movie.update', $movie->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
                        @endif


                        <div class="form-group mb-3">
                            {!! Form::label('title', 'Title', []) !!}
                            {!! Form::text('title', isset($movie) ? $movie->title : '', [
                                'class' => 'form-control',
                                'placehoder' => 'Typing title of movie...',
                                'id' => 'slug',
                                'onkeyup' => 'ChangeToSlug()',
                            ]) !!}
                        </div>
                        <div class="form-group mb-3">
                            {!! Form::label('slug', 'Slug', []) !!}
                            {!! Form::text('slug', isset($movie) ? $movie->slug : '', [
                                'style' => 'resize:none',
                                'class' => 'form-control',
                                'placehoder' => 'Typing slug of movie...',
                                'id' => 'convert_slug',
                            ]) !!}
                        </div>
                        <div class="form-group mb-3">
                            {!! Form::label('description', 'Description', []) !!}
                            {!! Form::textarea('description', isset($movie) ? $movie->description : '', [
                                'style' => 'resize:none',
                                'class' => 'form-control',
                                'placehoder' => 'Typing description of movie...',
                                'id' => 'descCate',
                            ]) !!}
                        </div>

                        <div class="form-group mb-3">
                            {!! Form::label('status', 'Status: ', []) !!}
                            {!! Form::select(
                                'status',
                                [
                                    '1' => 'Vissible',
                                    '0' => 'Hidden',
                                ],
                                isset($movie) ? $movie->status : '',
                                [
                                    'class' => 'form-control',
                                ],
                            ) !!}
                        </div>
                        <div class="form-group mb-3">
                            {!! Form::label('category_id', 'Category: ', []) !!}
                            {!! Form::select('category_id', $category, isset($movie) ? $movie->category_id : '', [
                                'class' => 'form-control',
                            ]) !!}
                        </div>
                        <div class="form-group mb-3">
                            {!! Form::label('country_id', 'Country: ', []) !!}
                            {!! Form::select('country_id', $country, isset($movie) ? $movie->country_id : '', [
                                'class' => 'form-control',
                            ]) !!}
                        </div>
                        <div class="form-group mb-3">
                            {!! Form::label('genre_id', 'Genre: ', []) !!}
                            {!! Form::select('genre_id', $genre, isset($movie) ? $movie->genre_id : '', [
                                'class' => 'form-control',
                            ]) !!}
                        </div>
                        <div class="form-group mb-3">
                            {!! Form::label('image', 'Image: ', []) !!}
                            {!! Form::file('image', ['class' => 'form-control']) !!}

                            @if (isset($movie))
                                <div class="my-4">
                                    <img class="img-fluid w-25" src="{{ asset('uploads/movie/' . $movie->image) }}"
                                        alt="{{ $movie->image }}">
                                </div>
                            @endif
                        </div>

                        @if (!isset($movie))
                            {!! Form::submit('Add movie', ['class' => 'btn btn-success']) !!}
                        @endif

                        @if (isset($movie))
                            {!! Form::submit('Update', ['class' => 'btn btn-success']) !!}
                        @endif


                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

            <div class="col-md-10 mt-5">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Image</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Description</th>
                            <th scope="col">Status</th>
                            <th scope="col">Category</th>
                            <th scope="col">Genre</th>
                            <th scope="col">Country</th>
                            <th scope="col">Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $key => $value)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $value->title }}</td>
                                <td><img class="img-fluid w-100" src="{{ asset('uploads/movie/' . $value->image) }}"
                                        alt="{{ $value->image }}"></td>
                                <td>{{ $value->slug }}</td>
                                <td style="width: 25%"><span class="line-2">{{ $value->description }}</span></td>
                                <td>
                                    @if ($value['status'])
                                        Hiện thị
                                    @else
                                        Ẩn
                                    @endif
                                </td>
                                <td>
                                    {{ $value->category->title }}
                                </td>
                                <td>
                                    {{ $value->genre->title }}
                                </td>
                                <td>
                                    {{ $value->country->title }}
                                </td>
                                <td>
                                    <div class="d-flex">
                                        {!! Form::open([
                                            'method' => 'DELETE',
                                            'route' => ['movie.destroy', $value->id],
                                            'onsubmit' => 'return confirm("Confirm delete?")',
                                        ]) !!}

                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}

                                        {!! Form::close() !!}

                                        <a class="btn btn-warning ms-2" href="{{ route('movie.edit', $value->id) }}">
                                            Edit
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <style>
        .line-2 {
            text-overflow: ellipsis;
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 8;
        }
    </style>
@endsection
