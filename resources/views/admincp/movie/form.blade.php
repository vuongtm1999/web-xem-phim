@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Manage Country</div>
                    <div class="card-body">

                        @if (!isset($country))
                            {!! Form::open(['route' => 'country.store', 'method' => 'POST']) !!}
                        @else
                            {!! Form::open(['route' => ['country.update', $country->id], 'method' => 'PUT']) !!}
                        @endif


                        <div class="form-group mb-3">
                            {!! Form::label('title', 'Title', []) !!}
                            {!! Form::text('title', isset($country) ? $country->title : '', [
                                'class' => 'form-control',
                                'placehoder' => 'Typing title of country...',
                                'id' => 'slug', 'onkeyup'=>'ChangeToSlug()',
                            ]) !!}
                        </div>
                        <div class="form-group mb-3">
                            {!! Form::label('slug', 'slug', []) !!}
                            {!! Form::text('slug', isset($country) ? $country->slug : '', [
                                'style' => 'resize:none',
                                'class' => 'form-control',
                                'placehoder' => 'Typing slug of country...',
                                'id' => 'convert_slug',
                            ]) !!}
                        </div>
                        <div class="form-group mb-3">
                            {!! Form::label('description', 'Description', []) !!}
                            {!! Form::textarea('description', isset($country) ? $country->description : '', [
                                'style' => 'resize:none',
                                'class' => 'form-control',
                                'placehoder' => 'Typing description of country...',
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
                                isset($country) ? $country->status : '',
                                [
                                    'class' => 'form-control',
                                ],
                            ) !!}
                        </div>

                        @if (!isset($country))
                            {!! Form::submit('Add country', ['class' => 'btn btn-success']) !!}
                        @endif

                        @if (isset($country))
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
                    <tbody>
                        @foreach ($list as $key => $value)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
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
                                            'route' => ['country.destroy', $value->id],
                                            'onsubmit' => 'return confirm("Confirm delete?")',
                                        ]) !!}
    
                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
    
                                        {!! Form::close() !!}
    
                                        <a class="btn btn-warning ms-2" href="{{ route('country.edit', $value->id) }}">
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
