@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card rounded-0">
                <div class="card-header bg-secondary rounded-0"><h4 class="text-white">{{ __('Edit').' '.$user[0]->user_title->TitleName.$user[0]->FirstName.' '.$user[0]->SecondName.'\'s Details' }}</h4></div>

                <div class="card-body rounded-0">
                    <form method="POST" action="{{ route('staff.update', ['staff' => $user[0]->Obfuscator]) }}">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        {{-- Titles --}}
                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                {{-- <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" required> --}}

                                <select name="title" id="title" class="form-control">

                                        @foreach ($titles as $title)
                                            @if (isset($user[0]->user_title->TitleName) && $title->id == $user[0]->user_title->id)
                                                <option value="{{ $user[0]->user_title->id }}" selected>{{ $user[0]->user_title->TitleName }}</option>
                                                @php
                                                    continue;
                                                @endphp
                                            @endif
                                            <option value="{{$title->id}}">{{ $title->TitleName }}</option>
                                        @endforeach
                                </select>

                                @if ($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- Feild for first name --}}
                        <div class="form-group row">
                            <label for="FirstName" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="FirstName" type="text" class="form-control{{ $errors->has('FirstName') ? ' is-invalid' : '' }}" name="FirstName" value="{{ $user[0]->FirstName }}" required autofocus>

                                @if ($errors->has('FirstName'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('FirstName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- Field for second name --}}
                        <div class="form-group row">
                            <label for="SecondName" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Second Name') }}</label>

                            <div class="col-md-6">
                                <input id="SecondName" type="text" class="form-control{{ $errors->has('SecondName') ? ' is-invalid' : '' }}" name="SecondName" value="{{ $user[0]->SecondName }}" required autofocus>

                                @if ($errors->has('SecondName'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('SecondName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- Email Address --}}
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user[0]->email }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
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
                                    @if ($user[0]->gender === 'Male')
                                        <div class="col">
                                            Male: <input type="radio" value="Male" name="gender" class="btn" checked>
                                        </div>
                                        <div class="col">
                                            Female: <input type="radio" value="Female" name="gender" class="btn">
                                        </div>
                                    @else
                                        <div class="col">
                                            Male: <input type="radio" value="Male" name="gender" class="btn">
                                        </div>
                                        <div class="col">
                                            Female: <input type="radio" value="Female" name="gender" class="btn" checked>
                                        </div>
                                    @endif
                                </div>

                                @if ($errors->has('gender'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- User Roles --}}
                        <div class="form-group row">
                            <label for="userrole" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('User Role') }}</label>

                            <div class="col-md-6">
                                {{-- <input id="userrole" type="text" class="form-control{{ $errors->has('userrole') ? ' is-invalid' : '' }}" name="userrole" value="{{ old('userrole') }}" required> --}}

                                <select name="userrole" id="userrole" class="form-control">
                                        @foreach ($userRoles as $role)
                                            @if (isset($user[0]->user_role->RoleName) && $user[0]->user_role->id == $role->id)
                                                <option value="{{ $user[0]->user_role->id }}" selected>{{ $user[0]->user_role->RoleName }}</option>
                                                @php
                                                    continue;
                                                @endphp
                                            @endif
                                            <option value="{{$role->id}}">{{ $role->RoleName }}</option>
                                        @endforeach
                                </select>

                                @if ($errors->has('userrole'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('userrole') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- Password --}}
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"  placeholder="Type a password if you wish to change it">

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
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Retype the password">
                            </div>
                        </div>

                        {{-- Submit Button --}}
                        <div class="form-group row mb-0">
                            <div class="col-md-3 offset-md-2">
                                <button type="submit" class="btn btn-primary rounded-0">
                                    {{ __('Apply Changes') }}
                                </button>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('staff.show', ['staff' => $user[0]->Obfuscator]) }}" class="btn btn-secondary rounded-0">Back</a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
