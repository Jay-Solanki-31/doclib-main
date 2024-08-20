@extends('layouts.app')

@section('content')
    <div class="card card-secondary container p-0 rounded-0">
        <div class="card-header bg-secondary rounded-0">
            <div class="row">
                <h4 class="col-md-10 text-white">Teachers</h4>
                <a href="{{route('teachers.create')}}" class="btn btn-outline-light rounded-0">Add New Teacher</a>
            </div>
        </div>
        <div class="card-body rounded-0">
            <div class="table-hover">
                @if (count($teachers) > 0)
                    <table class="table">
                        <thead>
                            <th class="font-weight-bold">ID</th>
                            <th class="font-weight-bold">Name</th>
                            <th class="font-weight-bold">Teacher of</th>
                            <th class="font-weight-bold">Class</th>
                            <th class="font-weight-bold">Phone Number</th>
                            <th class="font-weight-bold">Email</th>
                            <th class="font-weight-bold">Added By</th>
                            <th class="font-weight-bold">Date Added</th>
                            <th class="font-weight-bold">#</th>
                        </thead>
                        <tbody>
                            @foreach ($teachers as $teacher)
                                <tr>
                                    <td> TCH-{{ $teacher->id }} </td>
                                    <td><a href="{{route('teachers.show', ['teacher' => $teacher->id])}}" class="link">{{ $teacher->other_usr->user_title->TitleName.' '.$teacher->FirstName.' '.$teacher->MiddleName.' '.$teacher->SurName }}</a></td>
                                    <td>{{$teacher->school->Name }}</td>
                                    <td>{{$teacher->class->Name }}</td>
                                    <td>{{$teacher->PhoneNumber }}</td>
                                    <td>{{$teacher->Email }}</td>
                                    <td>{{$teacher->user->FirstName.' '.$teacher->user->SecondName }}</td>
                                    <td>{{$teacher->created_at }}</td>
                                    <td>
                                        <form action="{{ route('teachers.destroy', ['teacher' => $teacher->id ]) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <input type="submit" value="Delete" class="btn btn-danger">
                                        </form>
                                        <a href="{{ route('teachers.edit', ['teacher' => $teacher->id]) }}" class="btn btn-warning">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-danger">
                        <p>No teachers in the System</p>
                    </div>
                @endif
                {{ $teachers->links() }}
            </div>
        </div>
    </div>
@endsection
