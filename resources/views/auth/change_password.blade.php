@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Change Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.postchangePassword') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="old-password" class="col-md-4 col-form-label text-md-right">{{ __('Old Password') }}</label>

                            <div class="col-md-6">
                                <input id="old-password" type="password" class="form-control{{ $errors->has('old-password') ? ' is-invalid' : '' }}" name="old-password" value="{{ old('old-password') }}" required autofocus>

                                @if ($errors->has('old-password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('old-password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password-confirm" required>
                            </div>

                            @if ($errors->has('password-confirm'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password-confirm') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Change Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
