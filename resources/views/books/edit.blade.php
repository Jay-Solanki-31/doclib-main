@extends('layouts.app')

@section('content')
    <div class="card card-secondary container p-0 rounded-0">
        <div class="card-header bg-secondary rounded-0">
            <div class="row">
                <h4 class="col-md-10 text-white">Edit Book Information</h4>
            </div>
        </div>
        <div class="card-body rounded-0">
            <form action="{{ route('books.update', ['book' => $book->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                {{-- Books Name field --}}
                <div class="form-group row">
                    <label for="Name" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Name') }}</label>

                    <div class="col-md-6">
                        <input id="Name" type="text" class="rounded-0 form-control{{ $errors->has('Name') ? ' is-invalid' : '' }}" name="Name" value="{{ $book->Name }}" required autofocus>

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
                        <input id="ISBN" type="text" class="rounded-0 form-control{{ $errors->has('PrimaryContact') ? ' is-invalid' : '' }}" name="ISBN" value="{{ $book->ISBN }}" required autofocus>

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
                        <input id="Aurthor" type="text" class="rounded-0 form-control{{ $errors->has('Aurthor') ? ' is-invalid' : '' }}" name="Aurthor" value="{{ $book->Aurthor }}" required autofocus>

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
                        <input id="Edition" type="text" class="rounded-0 form-control{{ $errors->has('PrimaryContact') ? ' is-invalid' : '' }}" name="Edition" value="{{ $book->Edition }}" required autofocus>

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
                                @foreach ($book_types as $book_type)
                                @if ($book->BookTypeID === $book_type->id)
                                    <option value="{{$book_type->id}}" selected>{{ $book_type->Name }}</option>
                                    @php
                                        continue;
                                    @endphp
                                @endif
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
                                @foreach ($classes as $class)
                                    @if ($book->ClassID === $class->id)
                                        <option value="{{$class->id}}" selected>{{ $class->Name }}</option>
                                        @php
                                            continue;
                                        @endphp
                                    @endif
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
