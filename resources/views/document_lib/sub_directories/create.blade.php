@extends('layouts.app')

@section('content')

    <div class="container">
        <h1 class="color-5">Create Sub Directory - {{ $parent_dir->directory_name }}</h1>

        <div class="row mt-5 mb-5">
            <div class="col-md-8">
                <form method="POST" action="{{ route('dirs.store') }}">

                    {{ csrf_field() }}

                    <input type="hidden" name="parent_dir" value="{{ $parent_dir->obfuscator }}">
                    <input type="hidden" name="parent" value="{{ $parent }}">

                    <div class="form-group">
                        <label class="color-5 font-weight-bold">Name of Directory:</label>
                        <input type="text" class="form-control rounded-0" name="directory_name" required>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-dark btn-block rounded-0">Submit</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

@endsection
