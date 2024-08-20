@extends('layouts.app')

@section('content')
    <div class="card card-secondary container p-0 rounded-0">
        <div class="card-header bg-secondary rounded-0">
            <div class="row">
                <h4 class="col-md-10 text-white">Classes</h4>
                <a href="{{route('classes.create')}}" class="btn btn-outline-light rounded-0">Add New Class</a>
            </div>
        </div>
        <div class="card-body rounded-0">
            <div class="table-hover">
                @if (count($classes) > 0)
                    <table class="table">
                        <thead>
                            <th class="font-weight-bold">ID</th>
                            <th class="font-weight-bold">Name</th>
                            <th class="font-weight-bold">Level</th>
                            <th class="font-weight-bold">Description</th>
                            <th class="font-weight-bold">Created By</th>
                            <th class="font-weight-bold">No. of Students</th>
                            <th class="font-weight-bold">Created AT</th>
                        </thead>
                        <tbody>
                            @foreach ($classes as $class)
                                <tr>
                                    <td> SCH-{{ $class->id }} </td>
                                    <td><a href="{{route('classes.show', ['class' => $class->id])}}" class="link">{{$class->Name }}</a></td>
                                    <td>{{$class->Level }}</td>
                                    <td>{{$class->Description }}</td>
                                    <td>{{$class->user->FirstName.' '.$class->user->SecondName }}</td>
                                    <td>Comming Soon</td>
                                    <td>{{$class->created_at }}</td>
                                    <td>
                                        <form action="{{ route('classes.destroy', ['class' => $class->id ]) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <input type="submit" value="Delete" class="btn btn-danger">
                                        </form>
                                        <a href="{{ route('classes.edit', ['class' => $class->id]) }}" class="btn btn-warning">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-danger">
                        <p>No classes in the System</p>
                    </div>
                @endif
                {{ $classes->links() }}
            </div>
        </div>
    </div>
@endsection
