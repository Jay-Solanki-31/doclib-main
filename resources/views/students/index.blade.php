@extends('layouts.app')

@section('content')
    <div class="card card-secondary container p-0 rounded-0">
        <div class="card-header bg-secondary rounded-0">
            <div class="row">
                <h4 class="col-md-10 text-white">Students</h4>
                <a href="{{route('students.create')}}" class="btn btn-outline-light rounded-0">Add New Student</a>
            </div>
        </div>
        <div class="card-body rounded-0">
            <div class="table-hover">
                @if (count($students) > 0)
                    <table class="table">
                        <thead>
                            <th class="font-weight-bold">ID</th>
                            <th class="font-weight-bold">Name</th>
                            <th class="font-weight-bold">Student of</th>
                            <th class="font-weight-bold">Class</th>
                            <th class="font-weight-bold">Date of Birth</th>
                            <th class="font-weight-bold">Parent's Name</th>
                            <th class="font-weight-bold">Parent's Phone Number</th>
                            <th class="font-weight-bold">Login Email</th>
                            <th class="font-weight-bold">Added By</th>
                            <th class="font-weight-bold">Date Added</th>
                            <th class="font-weight-bold">#</th>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <td> TCH-{{ $student->id }} </td>
                                    <td><a href="{{route('students.show', ['student' => $student->id])}}" class="link">{{ $student->other_usr->user_title->TitleName.' '.$student->FirstName.' '.$student->MiddleName.' '.$student->SurName }}</a></td>
                                    <td>{{$student->school->Name }}</td>
                                    <td>{{$student->class->Name }}</td>
                                    <td>{{$student->DOB }}</td>
                                    <td>{{$student->ParentName }}</td>
                                    <td>{{$student->ParentContact }}</td>
                                    <td>{{$student->other_usr->email }}</td>
                                    <td>{{$student->user->FirstName.' '.$student->user->SecondName }}</td>
                                    <td>{{$student->created_at }}</td>
                                    <td>
                                        <form action="{{ route('students.destroy', ['student' => $student->id ]) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <input type="submit" value="Delete" class="btn btn-danger">
                                        </form>
                                        <a href="{{ route('students.edit', ['student' => $student->id]) }}" class="btn btn-warning">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-danger">
                        <p>No students in the System</p>
                    </div>
                @endif
                {{ $students->links() }}
            </div>
        </div>
    </div>
@endsection
