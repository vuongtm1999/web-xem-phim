@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Manage category</div>
                    <div class="card-body">

                        @if (!isset($category))
                            {!! Form::open(['route' => 'category.store', 'method' => 'POST']) !!}
                        @else
                            {!! Form::open(['route' => ['category.update', $category->id], 'method' => 'PUT']) !!}
                        @endif


                        <div class="form-group mb-3">
                            {!! Form::label('title', 'Title', []) !!}
                            {!! Form::text('title', isset($category) ? $category->title : '', [
                                'class' => 'form-control',
                                'placehoder' => 'Typing title of category...',
                                'id' => 'slug', 'onkeyup'=>'ChangeToSlug()',
                            ]) !!}
                        </div>
                        <div class="form-group mb-3">
                            {!! Form::label('slug', 'slug', []) !!}
                            {!! Form::text('slug', isset($category) ? $category->slug : '', [
                                'style' => 'resize:none',
                                'class' => 'form-control',
                                'placehoder' => 'Typing slug of category...',
                                'id' => 'convert_slug',
                            ]) !!}
                        </div>
                        <div class="form-group mb-3">
                            {!! Form::label('description', 'Description', []) !!}
                            {!! Form::textarea('description', isset($category) ? $category->description : '', [
                                'style' => 'resize:none',
                                'class' => 'form-control',
                                'placehoder' => 'Typing description of category...',
                                'id' => 'descCate',
                            ]) !!}
                        </div>


                        <div class="form-group mb-3">
                            {!! Form::label('status', 'Status', []) !!}
                            {!! Form::select(
                                'status',
                                [
                                    '1' => 'Vissible',
                                    '0' => 'Hidden',
                                ],
                                isset($category) ? $category->status : '',
                                [
                                    'class' => 'form-control',
                                ],
                            ) !!}
                        </div>

                        @if (!isset($category))
                            {!! Form::submit('Add category', ['class' => 'btn btn-success']) !!}
                        @endif

                        @if (isset($category))
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
                            <th scope="col">Slug</th>
                            <th scope="col">Description</th>
                            <th scope="col">Active/Inactive</th>
                            <th scope="col">Manage</th>
                        </tr>
                    </thead>
                    <tbody class="order_position">
                        @foreach ($list as $key => $value)
                            <tr id="{{ $value->id }}">
                                <th scope="row">{{ $value->position }}</th>
                                <td>{{ $value->title }}</td>
                                <td>{{ $value->slug }}</td>
                                <td>{{ $value->description }}</td>
                                <td>
                                    @if ($value['status'])
                                        Hiện thị
                                    @else
                                        Ẩn
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex">
                                        {!! Form::open([
                                            'method' => 'DELETE',
                                            'route' => ['category.destroy', $value->id],
                                            'onsubmit' => 'return confirm("Confirm delete?")',
                                        ]) !!}

                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}

                                        {!! Form::close() !!}

                                        <a class="btn btn-warning ms-2" href="{{ route('category.edit', $value->id) }}">
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
@endsection
