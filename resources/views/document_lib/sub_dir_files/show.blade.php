@extends('layouts.app')

@section('content')

    <div class="container">
        <h1 class="color-5">File Details</h1>

        {{-- d 	name 	file 	description 	file_extension 	directory_id 	user_id 	edited_by 	created_at 	updated_at  --}}

        <div class="row">
            <div class="col-md-2 offset-md-6">
            <a href="../../storage/doc_lib/{{ $parent_dir->directory_name }}/{{$directory->directory_name}}/{{ $file->file }}" class="btn btn-success btn-block rounded-0">Open File</a>
            </div>
            <div class="col-md-2">
                <a href="{{ route('dir_files.edit', $file->obfuscator) }}" class="btn btn-secondary btn-block rounded-0">
                    Edit File Name
                </a>
            </div>
            <div class="col-md-2">
                <form method="POST" action="{{route('dir_files.destroy', $file->obfuscator)}}">
                    @method('DELETE')
                    {{ csrf_field() }}
                    <button class="btn btn-danger btn-block rounded-0" data-toggle="confirmation" title="Delete File?" type="submit">Delete</button>
                </form>
            </div>
        </div>

        <div class="row mt-5 mb-5">
            <div class="col-md-8">
                <div class="card rounded-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="font-weight-bold">File Name:</p>
                            </div>
                            <div class="col-md-6">
                                <p>{{ $file->name }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="font-weight-bold">File Type:</p>
                            </div>
                            <div class="col-md-6">
                                <p>{{ $file->file_extension }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="font-weight-bold">Parent Directory:</p>
                            </div>
                            <div class="col-md-6">
                                <p><a href="{{ route('dirs.show', $directory->obfuscator) }}" class="color-5 no-text-decoration">{{ $directory->directory_name }} <i class="fas fa-external-link-alt text-dark"></i></a></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="color-5 font-weight-bold">Last Updated:</p>
                            </div>
                            <div class="col-md-6">
                                <p>{{ $file->updated_at }}</p>
                            </div>
                        </div>
                    </div>
                </div>{{-- end of card --}}
            </div>
        </div>
    </div>

@endsection
