@extends('layouts.app')

@section('content')
    <div class="card card-secondary container p-0 rounded-0">
        <div class="card-header bg-secondary rounded-0">
            <div class="row">
                <h4 class="col-md-10 text-white">Add New School</h4>
            </div>
        </div>
        <div class="card-body rounded-0">
            <form action="{{ route('schools.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                {{-- Schools Name field --}}
                <div class="form-group row">
                    <label for="Name" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Name') }}</label>

                    <div class="col-md-6">
                        <input id="Name" type="text" class="rounded-0 form-control{{ $errors->has('Name') ? ' is-invalid' : '' }}" name="Name" value="{{ old('Name') }}" required autofocus>

                        @if ($errors->has('Name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('Name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                {{-- Primary Contact field --}}
                <div class="form-group row">
                    <label for="PrimaryContact" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Primary Contact') }}</label>

                    <div class="col-md-6">
                        <input id="PrimaryContact" type="text" class="rounded-0 form-control{{ $errors->has('PrimaryContact') ? ' is-invalid' : '' }}" name="PrimaryContact" value="{{ old('PrimaryContact') }}" required autofocus>

                        @if ($errors->has('PrimaryContact'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('PrimaryContact') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                {{-- School's Motto field --}}
                <div class="form-group row">
                    <label for="Motto" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Motto') }}</label>

                    <div class="col-md-6">
                        <textarea id="Motto" class="rounded-0 form-control{{ $errors->has('Motto') ? ' is-invalid' : '' }}" name="Motto">{{ old('Motto') }}</textarea>

                        @if ($errors->has('Motto'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('Motto') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                {{-- Schools Phyiscal Location field --}}
                <div class="form-group row">
                    <label for="PhyiscalLocation" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Phyiscal Location') }}</label>

                    <div class="col-md-6">
                        <textarea id="PhyiscalLocation" class="rounded-0 form-control{{ $errors->has('PhyiscalLocation') ? ' is-invalid' : '' }}" name="PhyiscalLocation">{{ old('PhyiscalLocation') }}</textarea>

                        @if ($errors->has('PhyiscalLocation'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('PhyiscalLocation') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                {{-- Schools Logo field --}}
                <div class="form-group row">
                    <label for="Logo" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Logo') }}</label>

                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="custom-file{{ $errors->has('lib_file') ? ' is-invalid' : '' }}">
                                <input type="file" class="custom-file-input rounded-0" id="fileUpload" name="lib_file" value="{{ old('lib_file') }}">
                                <label class="custom-file-label color-5 rounded-0" for="fileUpload">Choose File</label>
                            </div>
                        </div>
                        @if ($errors->has('lib_file'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('lib_file') }}</strong>
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
                        <a href="{{ route('schools.index') }}" class="btn btn-secondary rounded-0 btn-block">Close</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
