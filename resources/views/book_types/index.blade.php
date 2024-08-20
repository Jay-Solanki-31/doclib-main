@extends('layouts.app')

@section('content')
    <div class="card card-secondary container p-0 rounded-0">
        <div class="card-header bg-secondary rounded-0">
            <div class="row">
                <h4 class="col-md-10 text-white">Book Types</h4>
                <a href="{{route('book-types.create')}}" class="btn btn-outline-light rounded-0">Add New Book Type</a>
            </div>
        </div>
        <div class="card-body rounded-0">
            <div class="table-hover">
                @if (count($book_types) > 0)
                    <table class="table">
                        <thead>
                            <th class="font-weight-bold">ID</th>
                            <th class="font-weight-bold">Name</th>
                            <th class="font-weight-bold">Description</th>
                            <th class="font-weight-bold">Date Added</th>
                            <th class="font-weight-bold">#</th>
                        </thead>
                        <tbody>
                            @foreach ($book_types as $book_type)
                                <tr>
                                    <td> DEP-{{ $book_type->id }} </td>
                                    <td><a href="{{route('book-types.show', ['book_type' => $book_type->id])}}" class="link">{{$book_type->Name }}</a></td>
                                    @if ($book_type->Description != '')
                                        <td>{{$book_type->Description }}</td>

                                    @else
                                        <td>None</td>
                                    @endif
                                    <td>{{$book_type->created_at }}</td>
                                    <td>
                                        <form action="{{ route('book-types.destroy', ['book_type' => $book_type->id ]) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <input type="submit" value="Delete" class="btn btn-danger">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-danger">
                        <p>No book types in the System</p>
                    </div>
                @endif
                {{ $book_types->links() }}
            </div>
        </div>
    </div>
@endsection
