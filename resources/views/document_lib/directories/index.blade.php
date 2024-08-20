@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Library</h1>

        <div class="row mt-5">
            <div class="col-md-2">
                <h5 class="text-secondary mb-3">Directories</h5>
                <h1>{{ $directory_count }}</h1>
            </div>
            <div class="col-md-2">
                <h5 class="text-secondary mb-3">Files</h5>
                <h1>{{ $file_count }}</h1>
            </div>
        </div>

        <div class="row mt-5 mb-5">
            <div class="col-md-4">
                <form action="" method="post">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <input type="search" placeholder="Search..." name="search_library" class="form-control rounded-0">
                    </div>

                </form>
            </div>
            <div class="col-md-4 offset-md-4">
                <a href="{{ route('library.create') }}" class="btn btn-outline-dark btn-block rounded-0">
                    Add Directory
                </a>
            </div>
        </div>

        <hr />

        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    @if (count($directories) > 0)
                        @foreach ($directories as $directory)
                            <div class="col-md-3 mt-3">
                                <a href="{{ route('library.show', $directory->obfuscator) }}" class="no-text-decoration text-dark" data-toggle="tooltip" data-placement="bottom" title="Open {{$directory->directory_name}}">
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
            </div>
        </div>

    </div>

@endsection
