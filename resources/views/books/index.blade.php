@extends('layouts.app')

@section('content')
    <div class="card card-secondary container p-0 rounded-0">
        <div class="card-header bg-secondary rounded-0">
            <div class="row">
                <h4 class="col-md-10 text-white">Books</h4>
                <a href="{{route('books.create')}}" class="btn btn-outline-light rounded-0">Add New Book</a>
            </div>
        </div>
        <div class="card-body rounded-0">
            <div class="table-hover">
                @if (count($books) > 0)
                    <table class="table">
                        <thead>
                            <th class="font-weight-bold">ID</th>
                            <th class="font-weight-bold">Name</th>
                            <th class="font-weight-bold">ISBN</th>
                            <th class="font-weight-bold">Aurthor</th>
                            <th class="font-weight-bold">Edition</th>
                            <th class="font-weight-bold">Subject</th>
                            <th class="font-weight-bold">Class</th>
                            <th class="font-weight-bold">Date Added</th>
                            <th class="font-weight-bold">#</th>
                        </thead>
                        <tbody>
                            @foreach ($books as $book)
                                <tr>
                                    <td> SCH-{{ $book->id }} </td>
                                    <td><a href="{{route('books.show', ['book' => $book->id])}}" class="link">{{$book->Name }}</a></td>
                                    <td>{{$book->ISBN }}</td>
                                    <td>{{$book->Aurthor }}</td>
                                    <td>{{$book->Edition }}</td>
                                    <td>{{ $book->type->Name}}</td>
                                    <td>{{ $book->class->Name }}</td>
                                    <td>{{$book->created_at }}</td>
                                    <td>
                                        <form action="{{ route('books.destroy', ['book' => $book->id ]) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <input type="submit" value="Delete" class="btn btn-danger">
                                        </form>
                                        <a href="{{ route('books.edit', ['book' => $book->id]) }}" class="btn btn-warning">Edit</a>
                                        <a href="storage/{{ $book->Location }}" class="btn btn-success" target="_blanc">Read</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-danger">
                        <p>No books in the System</p>
                    </div>
                @endif
                {{ $books->links() }}
            </div>
        </div>
    </div>
@endsection
