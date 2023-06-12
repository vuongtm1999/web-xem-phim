@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 mt-3">
                <a href="{{ route('movie.create') }}" class="btn btn-success d-inline-block fw-bold mb-3">Create film</a>
                <table id="myFilm" class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Image</th>
                            <th scope="col">Slug</th>
                            {{-- <th scope="col">Description</th> --}}
                            <th scope="col">Status</th>
                            <th scope="col">Is it trend?</th>
                            <th scope="col">Category</th>
                            <th scope="col">Genre</th>
                            {{-- <th scope="col">Country</th> --}}
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
                                {{-- <td style="width: 25%"><span class="line-2">{{ $value->description }}</span></td> --}}
                                <td>
                                    @if ($value['status'])
                                        Hiện thị
                                    @else
                                        Ẩn
                                    @endif
                                </td>
                                <td>
                                    @if ($value['phim_hot'])
                                        Có
                                    @else
                                        Không
                                    @endif
                                </td>
                                <td>
                                    {{ $value->category->title }}
                                </td>
                                <td>
                                    {{ $value->genre->title }}
                                </td>
                                {{-- <td>
                                    {{ $value->country->title }}
                                </td> --}}
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
