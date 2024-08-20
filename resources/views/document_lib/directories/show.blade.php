@extends('layouts.app')

@section('content')

    <div class="container">

        <h1 class="color-5">{{ $directory->directory_name }}</h1>

        <div class="row mt-5">
            <div class="col-md-2">
                <h5 class="text-secondary mb-3">Directories</h5>
                <h1>{{ $sub_dir_count }}</h1>
            </div>
            <div class="col-md-2">
                <h5 class="text-secondary mb-3">Files</h5>
                <h1>{{ $file_count }}</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2 offset-md-4">
                <a href="{{ route('lib_files.create', ['directory' => $directory->id]) }}" title="Upload Document" class="btn btn-outline-dark btn-block rounded-0" data-toggle="tooltip" data-placement="bottom" title="Upload Document">
                    <i class="fas fa-file-upload"></i>
                </a>
            </div>
            <div class="col-md-2">
                <a href="{{ route('dirs.create', ['directory' => $directory->obfuscator, 'in' => 'lib']) }}" class="btn btn-outline-secondary btn-block rounded-0" data-toggle="tooltip" data-placement="bottom" title="Create Directory">
                    <i class="fas fa-folder-open"></i>
                </a>
            </div>
            <div class="col-md-2">
                <a href="{{ route('library.edit', $directory->id) }}" class="btn btn-outline-success btn-block rounded-0" data-toggle="tooltip" data-placement="bottom" title="Edit Directory">
                    <i class="fas fa-edit"></i>
                </a>
            </div>
            <div class="col-md-2">
                <form method="POST" action="{{route('library.destroy', $directory->id)}}">
                    @method('DELETE')
                    {{ csrf_field() }}
                    <button class="btn btn-outline-danger btn-block rounded-0" type="submit" data-toggle="confirmation" title="Delete Directory?">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>
            </div>
        </div>

        <hr />

        <div class="row">
            <div class="col-md-12">
                {{-- Directories --}}
                <div class="row">
                    @if (count($sub_dirs) > 0)
                        @foreach ($sub_dirs as $directory)
                            <div class="col-md-3 mt-3">
                            <a href="{{ route('dirs.show', $directory->obfuscator) }}" class="no-text-decoration text-dark" data-toggle="tooltip" data-placement="bottom" title="Open {{$directory->directory_name}}">
                                    <div class="card rounded-0">
                                        <div class="card-body p-2">
                                            <i class="fas fa-folder-open text-dark mr-2"></i>
                                            {{ $directory->directory_name }}
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="row">
                    @if (count($files) > 0)
                        @foreach ($files as $file)
                            <div class="col-md-3 mt-3">
                                <a href="{{ route('lib_files.show', $file->id) }}" class="no-text-decoration text-dark">
                                    <div class="card rounded-0">
                                        <div class="card-body p-2">
                                            @if ($file->file_extension == 'pdf')
                                                <i class="fas fa-file-pdf text-danger mr-2"></i>
                                            @elseif($file->file_extension == 'doc' || $file->file_extension == 'docx')
                                                <i class="fas fa-file-word mr-2" style="color:#0000b3;"></i>
                                            @elseif($file->file_extension == 'xls' || $file->file_extension == 'xlsx')
                                                <i class="fas fa-file-excel  text-success mr-2"></i>
                                            @elseif($file->file_extension == 'csv')
                                                <i class="fas fa-file-csv  text-success mr-2"></i>
                                            @elseif($file->file_extension == 'ppt' || $file->file_extension == 'pptx')
                                                <i class="fas fa-file-powerpoint text-warning mr-2"></i>
                                            @elseif($file->file_extension == 'jpg' || $file->file_extension == 'jpeg' || $file->file_extension == 'png' || $file->file_extension == 'gif' || $file->file_extension == 'tiff')
                                                <i class="fas fa-file-image mr-2"></i>
                                            @endif
                                            {{ $file->name }}
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

    </div>

@endsection
