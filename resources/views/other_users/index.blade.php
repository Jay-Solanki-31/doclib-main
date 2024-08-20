@extends('layouts.app2')

@section('content')
<div id="allTheThings">
    <a href="{{ route('teacher.insert_book') }}">
        <input type="button" value="Insert New Book Record" />
    </a><br />
    <a href="{{ route('start.books') }}">
        <input type="button" value="List All Books" />
    </a><br />
    <a href="{{ route('students.create') }}">
        <input type="button" value="Add A Student" />
    </a><br />
    <a href="{{ route('students.index') }}">
        <input type="button" value="List all students" />
    </a><br />
    <a href="#">
        <input type="button" value="View Books activities" />
    </a><br />
    <a href="{{ route('teachers.index') }}">
        <input type="button" value="List Teachers" />
    </a><br />
    <a href="">
        <input type="button" value="View School Details" />
    </a><br />
</div>
@endsection