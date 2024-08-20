@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 text-center">
                <h1 class="color-5">Edit File Details</h1>
            </div>
        </div>

        <hr />
        {{-- id 	name 	file 	description 	file_extension 	directory_id 	user_id 	edited_by 	created_at 	updated_at  --}}

        <div class="row">
            <div class="col-md-8 offset-md-2">
                <form method="POST" action="{{ route('lib_files.update', $file->id) }}">

                    @method('PUT')
                    {{ csrf_field() }}

                    {{-- <input type="hidden" name="directory" value="{{ $directory->id }}"> --}}

                    <div class="form-group">
                        <label class="color-5 font-weight-bold">Name of File:</label>
                        <input type="text" name="file_name" class="form-control" value="{{ $file->name }}" required>
                    </div>

                    <div class="form-group">
                        <label class="color-5 font-weight-bold">Description:</label>
                        <textarea class="form-control" rows="5" name="description">{{ $file->description }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-dark btn-block">Submit</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection
