@extends('layouts.app2')

@section('content')
<div class="container">

    <div class="row">
        @isset($url)
        <form class="cd-form col-6" method="POST" action="{{ url("login/$url") }}">
        @else
        <form class="cd-form" method="POST" action="{{ route('login') }}">
        @endisset
            @csrf	
            <center><legend>{{ isset($url) ? ucwords($url) : ""}} {{ __('Login') }}</legend></center>
            
            @if($errors->any())
                {!! implode('', $errors->all('<div class="error-message" id="error-message"><p id="error">:message</p></div>')) !!}
            @endif
            <div class="error-message" id="error-message">
                <p id="error"></p>
            </div>
            
            <div class="icon">
                <input class="m-user{{ $errors->has('email') ? ' is-invalid' : '' }}" type="text" name="email" placeholder="Email" required />
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            
            <div class="icon">
                <input class="m-pass{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" name="password" placeholder="Password" required />
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            
            <input type="submit" value="Login" name="m_login" />
            
            <br /><br /><br /><br />
        
            <p align="center"><a href="/" style="text-decoration:none;">Go Back</a>
        </form>
    </div>
</div>
@endsection
