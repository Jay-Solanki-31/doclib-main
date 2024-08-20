@extends('layouts.app')

@section('content')
    <div class="card card-secondary container p-0 rounded-0">
        <div class="card-header bg-secondary rounded-0">
            <div class="row">
                <h4 class="col-md-10 text-white">Add New Book</h4>
            </div>
        </div>
        <div class="card-body rounded-0">
            <form action="{{ route('books.store') }}" method="post" enctype="multipart/form-data">
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

                {{-- ISBN field --}}
                <div class="form-group row">
                    <label for="ISBN" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('ISBN') }}</label>

                    <div class="col-md-6">
                        <input id="ISBN" type="text" class="rounded-0 form-control{{ $errors->has('PrimaryContact') ? ' is-invalid' : '' }}" name="ISBN" value="{{ old('ISBN') }}" required autofocus>

                        @if ($errors->has('ISBN'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('ISBN') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                {{-- Aurthor field --}}
                <div class="form-group row">
                    <label for="Aurthor" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Aurthor') }}</label>

                    <div class="col-md-6">
                        <input id="Aurthor" type="text" class="rounded-0 form-control{{ $errors->has('Aurthor') ? ' is-invalid' : '' }}" name="Aurthor" value="{{ old('Aurthor') }}" required autofocus>

                        @if ($errors->has('Aurthor'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('Aurthor') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                {{-- Edition field --}}
                <div class="form-group row">
                    <label for="Edition" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Edition') }}</label>

                    <div class="col-md-6">
                        <input id="Edition" type="text" class="rounded-0 form-control{{ $errors->has('PrimaryContact') ? ' is-invalid' : '' }}" name="Edition" value="{{ old('Edition') }}" required autofocus>

                        @if ($errors->has('Edition'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('Edition') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                {{-- BookTypeID --}}
                <div class="form-group row">
                    <label for="BookTypeID" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Subject / Book Type') }}</label>

                    <div class="col-md-6">
                        <select name="BookTypeID" id="BookTypeID" class="form-control">
                            @if (count($book_types) > 0)
                                <option value="#" selected disabled>-- choose --</option>
                                @foreach ($book_types as $book_type)
                                    <option value="{{$book_type->id}}">{{ $book_type->Name }}</option>
                                @endforeach
                            @else
                                <option value="#" disabled selected>-- No subject on the system --</option>
                            @endif
                            <option value=""></option>
                        </select>

                        @if ($errors->has('BookTypeID'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('BookTypeID') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                {{-- ClassID --}}
                <div class="form-group row">
                    <label for="ClassID" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Class') }}</label>

                    <div class="col-md-6">
                        <select name="ClassID" id="ClassID" class="form-control">
                            @if (count($classes) > 0)
                                <option value="#" selected disabled>-- choose --</option>
                                @foreach ($classes as $class)
                                    <option value="{{$class->id}}">{{ $class->Name }}</option>
                                @endforeach
                            @else
                                <option value="#" disabled selected>-- No classes on the system --</option>
                            @endif
                            <option value=""></option>
                        </select>

                        @if ($errors->has('ClassID'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('ClassID') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                {{-- file field --}}
                <div class="form-group row">
                    <label for="file" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Upload Document') }}</label>

                    <div class="col-md-6">
                        <input id="file" type="file" class="rounded-0 form-control{{ $errors->has('PrimaryContact') ? ' is-invalid' : '' }}" name="file" value="{{ old('file') }}" required autofocus>

                        @if ($errors->has('file'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('file') }}</strong>
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
                        <a href="{{ route('books.index') }}" class="btn btn-secondary rounded-0 btn-block">Close</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
