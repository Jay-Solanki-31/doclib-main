@extends('layouts.app2')

@section('content')
<div class="container">
    <table width='100%' cellpadding=10 cellspacing=10>
        <tr>
            <th>ISBN<hr></th>
            <th>Book Title<hr></th>
            <th>Author<hr></th>
            <th>Category<hr></th>
            <th>Class<hr></th>
            <th>Action<hr></th>
        </tr>
        @if (count($books) > 0)    
            @foreach ($books as $book)    
                <tr>
                    <td>{{ $book->ISBN }}</td>
                    <td>{{ $book->Name }}</td>
                    <td>{{ $book->Aurthor }}</td>
                    <td>{{ $book->type->Name }}</td>
                    <td>{{ $book->class->Name }}</td>
                    <td>
                        <div class="row">
                            <a href="storage/{{ $book->Location }}" target="_blanc" class="btn btn-success btn-outline-rounded col p-0"><i class="mdi mdi-book-open mdi-24px" title="read"></i></a>
                            @if (Auth::guard('other_user')->user()->UserRole === 1 && Auth::guard('other_user')->user()->id === $book->AddedBy && $book->Teacher === 1)
                                <form action="{{ route('books.destroy', ['book' => $book->id ]) }}" method="post" class="col">
                                    @csrf
                                    @method('delete')
                                    
                                    <button type="submit" value="Delete" class="btn btn-danger"><i class="mdi mdi-delete mdi-24px" title="read"></i></button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
        @else
            <tr><td class="text-danger">No books in the system</td></tr>
        @endif
    </table>
</div>
@endsection