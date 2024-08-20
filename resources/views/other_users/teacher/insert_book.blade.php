@extends('layouts.app2')

@section('content')
    <div class="container">
        <form class="cd-form" method="POST" action="{{ route('teacher.insert_book') }}" enctype="multipart/form-data">
            <center><legend>Add New Book Details</legend></center>
                @csrf
                <input type="hidden" name="directory_name" value="books/class/{{$class->Name}}">
                
                <div class="icon">
                    <input class="b-isbn{{ $errors->has('ISBN') ? ' is-invalid' : '' }}" id="b_isbn" type="number" name="ISBN" placeholder="ISBN" required value={{ old('ISBN') }} >
    
                    @if ($errors->has('ISBN'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('ISBN') }}</strong>
                        </span>
                    @endif
                </div>
                
                <div class="icon">
                    <input class="b-title{{ $errors->has('Name') ? ' is-invalid' : '' }}" type="text" name="Name" placeholder="Book Title" required value={{ old('Name') }} >
    
                    @if ($errors->has('Name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('Name') }}</strong>
                        </span>
                    @endif
                </div>
                
                <div class="icon">
                    <input class="b-author{{ $errors->has('Aurthor') ? ' is-invalid' : '' }}" type="text" name="Aurthor" placeholder="Author Name" required value={{ old('Aurthor') }} >
    
                    @if ($errors->has('Aurthor'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('Aurthor') }}</strong>
                        </span>
                    @endif
                </div>
    
                <div class="icon">
                    <input class="b-cc{{ $errors->has('Edition') ? ' is-invalid' : '' }}" type="text" name="Edition" placeholder="Edition" required value={{ old('Edition') }} >
    
                    @if ($errors->has('Edition'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('Edition') }}</strong>
                        </span>
                    @endif
                </div>
    
                <div>
                    <h4>Class</h4>
                
                    <p class="cd-select icon">
                        <select name="ClassID" class="b-category">
                            <option value="{{ $class->id }}">{{ $class->Name }}</option>
                        </select>
                    </p>
                </div>
                
                <div>
                <h4>Category</h4>
                
                    <p class="cd-select icon">
                        <select class="b-category{{ $errors->has('BookTypeID') ? ' is-invalid' : '' }}" name="BookTypeID">
                            @if (count($book_types) < 1)
                                <option value="#" selected disabled>-- no book types in the system</option>
                            @else
                                <option value="#" selected disabled>-- Choose an option --</option>
                                @foreach ($book_types as $book_type)
                                    <option value="{{$book_type->id}}">{{$book_type->Name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </p>
    
                    @if ($errors->has('BookTypeID'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('BookTypeID') }}</strong>
                        </span>
                    @endif
                </div>
                
                <div class="icon">
                    <input class="b-title{{ $errors->has('file') ? ' is-invalid' : '' }}" type="file" name="file" placeholder="Upload" value={{ old('file') }} >
    
                    @if ($errors->has('file'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('file') }}</strong>
                        </span>
                    @endif
                </div>
    
                <br >
                <a href="/starter">Back</a>
                <input class="b-isbn" type="submit" name="" value="Add book" >
        </form>
    </div>
@endsection