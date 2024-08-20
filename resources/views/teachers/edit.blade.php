@extends('layouts.app')

@section('content')
    <div class="card card-secondary container p-0 rounded-0">
        <div class="card-header bg-secondary rounded-0">
            <div class="row">
                <h4 class="col-md-10 text-white">Add a New Teacher</h4>
            </div>
        </div>
        <div class="card-body rounded-0">
            <form action="{{ route('teachers.update', ['teacher' => $teacher->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                {{-- Titles --}}
                <div class="form-group row">
                    <label for="title" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Title') }}</label>

                    <div class="col-md-6">
                        {{-- <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" required> --}}

                        <select name="title" id="title" class="form-control">
                            @if (count($titles) < 1)
                                <option value="0" selected disabled>No User Titles in the system</option>
                            @else
                                @foreach ($titles as $title)
                                    @if ($title->id === $teacher->other_usr->user_title->id)
                                        <option value="{{ $teacher->other_usr->user_title->id }}" selected>{{$teacher->other_usr->user_title->TitleName}}</option>
                                        @php
                                            continue;
                                        @endphp
                                    @endif
                                    <option value="{{$title->id}}">{{ $title->TitleName }}</option>
                                @endforeach
                            @endif
                        </select>

                        @if ($errors->has('title'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                
                {{-- Teacher FirstName field --}}
                <div class="form-group row">
                    <label for="FirstName" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('First Name') }}</label>

                    <div class="col-md-6">
                        <input id="FirstName" type="text" class="rounded-0 form-control{{ $errors->has('FirstName') ? ' is-invalid' : '' }}" name="FirstName" value="{{ $teacher->FirstName }}" required autofocus>

                        @if ($errors->has('FirstName'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('FirstName') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                {{-- Teacher MiddleName field --}}
                <div class="form-group row">
                    <label for="MiddleName" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Middle Name') }}</label>

                    <div class="col-md-6">
                        <input id="MiddleName" type="text" class="rounded-0 form-control{{ $errors->has('MiddleName') ? ' is-invalid' : '' }}" name="MiddleName" value="{{ $teacher->MiddleName }}" required autofocus>

                        @if ($errors->has('MiddleName'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('MiddleName') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                {{-- Teacher SurName field --}}
                <div class="form-group row">
                    <label for="SurName" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('SurName') }}</label>

                    <div class="col-md-6">
                        <input id="SurName" type="text" class="rounded-0 form-control{{ $errors->has('SurName') ? ' is-invalid' : '' }}" name="SurName" value="{{ $teacher->SurName }}" required autofocus>

                        @if ($errors->has('SurName'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('SurName') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                {{-- Gender --}}
                <div class="form-group row">
                    <label for="gender" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Gender') }}</label>

                    <div class="col-md-6">
                        {{-- <input id="gender" type="text" class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}" name="gender" value="{{ old('gender') }}" required> --}}

                        {{-- <select name="gender" id="gender" class="form-control">
                            <option value="0" selected disabled>-- Choose an option --</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select> --}}
                        <div class="row">
                            <div class="col">
                                Male: <input type="radio" value="Male" name="gender" class="btn">
                            </div>
                            <div class="col">
                                Female: <input type="radio" value="Female" name="gender" class="btn">
                            </div>
                        </div>

                        @if ($errors->has('gender'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('gender') }}</strong>
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
                                    @if ($class->id === $teacher->class->id)
                                        <option value="{{ $teacher->class->id }}" selected>{{ $teacher->class->Name }}</option>
                                        @php
                                            continue;
                                        @endphp
                                    @endif
                                    <option value="{{$class->id}}">{{ $class->Name }}</option>
                                @endforeach
                            @else
                                <option value="#" disabled selected>-- No classes on the system --</option>
                            @endif
                        </select>

                        @if ($errors->has('ClassID'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('ClassID') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                {{-- SchoolID --}}
                <div class="form-group row">
                    <label for="SchoolID" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('School') }}</label>

                    <div class="col-md-6">
                        <select name="SchoolID" id="SchoolID" class="form-control">
                            @if (count($schools) > 0)
                                @foreach ($schools as $school)
                                    @if ($school->id === $teacher->school->id)
                                        <option value="{{$school->id}}" selected>{{$teacher->school->Name}}</option>
                                        @php
                                            continue;
                                        @endphp
                                    @endif
                                    <option value="{{$school->id}}">{{ $school->Name }}</option>
                                @endforeach
                            @else
                                <option value="#" disabled selected>-- No schools on the system --</option>
                            @endif
                        </select>

                        @if ($errors->has('SchoolID'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('SchoolID') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                {{-- Teacher PhoneNumber field --}}
                <div class="form-group row">
                    <label for="PhoneNumber" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Phone Number') }}</label>

                    <div class="col-md-6">
                        <input id="PhoneNumber" type="text" class="rounded-0 form-control{{ $errors->has('PhoneNumber') ? ' is-invalid' : '' }}" name="PhoneNumber" value="{{ $teacher->PhoneNumber }}" required autofocus>

                        @if ($errors->has('PhoneNumber'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('PhoneNumber') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                {{-- Teacher Email field --}}
                <div class="form-group row">
                    <label for="Email" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Email') }}</label>

                    <div class="col-md-6">
                        <input id="Email" type="text" class="rounded-0 form-control{{ $errors->has('Email') ? ' is-invalid' : '' }}" name="Email" value="{{ $teacher->Email }}" required autofocus>

                        @if ($errors->has('Email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('Email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                {{-- Password --}}
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Can be left empty">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- Password Confirmation --}}
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Can be left empty">
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
                        <a href="{{ route('teachers.index') }}" class="btn btn-secondary rounded-0 btn-block">Close</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
