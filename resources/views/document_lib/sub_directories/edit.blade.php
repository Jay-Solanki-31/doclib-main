@extends('layouts.app')

@section('content')

    <div class="container">
        <h1 class="color-5">Edit Sub Directory</h1>

        <div class="row mt-5 mb-5">
            <div class="col-md-8">
                <form method="POST" action="{{ route('dirs.update', $directory->obfuscator) }}">

                    @method('PUT')
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label class="color-5 font-weight-bold">Name of Directory:</label>
                        <input type="text" class="form-control rounded-0" name="directory_name" value="{{ $directory->directory_name }}" required>
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
