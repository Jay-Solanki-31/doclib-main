@extends('layouts.app')

@section('content')
    <div class="card card-secondary container p-0 rounded-0">
        <div class="card-header bg-secondary rounded-0">
            <div class="row">
                <h4 class="col-md-10 text-white">Edit Class</h4>
            </div>
        </div>
        <div class="card-body rounded-0">
            <form action="{{ route('classes.update', ['class' => $class->id]) }}" method="post" enctype="multipart/form-data">
                @csrf

                {{-- Schools Name field --}}
                <div class="form-group row">
                    <label for="Name" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Name') }}</label>

                    <div class="col-md-6">
                        <input id="Name" type="text" class="rounded-0 form-control{{ $errors->has('Name') ? ' is-invalid' : '' }}" name="Name" value="{{ $class->Name }}" required autofocus>

                        @if ($errors->has('Name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('Name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                {{-- Class's Level field --}}
                <div class="form-group row">
                    <label for="Level" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Level') }}</label>

                    <div class="col-md-6">
                        <select name="Level" id="Level" class="rounded-0 form-control{{ $errors->has('Level') ? ' is-invalid' : '' }}">
                            <option value="{{ $class->Level }}" selected>{{ $class->Level }}</option>
                            <option value="Lower">Lower</option>
                            <option value="Middle">Middle</option>
                            <option value="Upper">Upper</option>
                        </select>

                        @if ($errors->has('Level'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('Level') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                {{-- Class's Description field --}}
                <div class="form-group row">
                    <label for="Description" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Description') }}</label>

                    <div class="col-md-6">
                        <textarea id="Description" class="rounded-0 form-control{{ $errors->has('Description') ? ' is-invalid' : '' }}" name="Description">{{ $class->Description }}</textarea>

                        @if ($errors->has('Description'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('Description') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                {{-- Submit Button --}}
                <div class="form-group row mb-0">
                    <div class="col-md-4 offset-md-2">
                        <button type="submit" class="btn btn-primary rounded-0 btn-block">
                            {{ __('Save') }}
                        </button>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('classes.index') }}" class="btn btn-secondary rounded-0 btn-block">Close</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
