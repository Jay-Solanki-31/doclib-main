@extends('layouts.app2')

@section('content')
<div id="allTheThings">
    <a href="{{ route('start.books') }}">
        <input type="button" value="List All Books" />
    </a><br />
    <a href="">
        <input type="button" value="View School Details" />
    </a><br />
</div>
@endsection