@extends('layouts.app2')

@section('content')
<div id="allTheThings">
    @if(Auth::guard('other_user')->user()->UserRole === 1)
        <a href="{{ route('teacher.books') }}">
            <input type="button" value="List All Books" />
        </a><br />
    @else
        <a href="{{ route('student.books') }}">
            <input type="button" value="List All Books" />
        </a><br />
    @endif
    @foreach ($book_types as $book_type)
        <a href="{{ route('get.books-type', ['typeID' => $book_type->id]) }}">
            <input type="button" value="{{ $book_type->Name }}" />
        </a><br />
    @endforeach
</div>
@endsection