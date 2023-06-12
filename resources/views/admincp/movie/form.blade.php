@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{ route('movie.index') }}" class="btn btn-primary d-inline-block fw-bold mb-3">List film</a>
                <div class="card">
                    <div class="card-header me-3">Manage Movie</div>
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
                            {!! Form::label('eng_title', 'English title:', []) !!}
                            {!! Form::text('eng_title', isset($movie) ? $movie->eng_title : '', [
                                'class' => 'form-control',
                                'placehoder' => 'Typing eng_title of movie...',
                                'id' => 'eng_title',
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
                            {!! Form::label('phim_hot', 'Hot: ', []) !!}
                            {!! Form::select(
                                'phim_hot',
                                [
                                    '1' => 'Có',
                                    '0' => 'Không',
                                ],
                                isset($movie) ? $movie->phim_hot : '',
                                [
                                    'class' => 'form-control',
                                ],
                            ) !!}
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
