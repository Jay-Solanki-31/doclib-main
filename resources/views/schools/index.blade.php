@extends('layouts.app')

@section('content')
    <div class="card card-secondary container p-0 rounded-0">
        <div class="card-header bg-secondary rounded-0">
            <div class="row">
                <h4 class="col-md-10 text-white">Schools</h4>
                <a href="{{route('schools.create')}}" class="btn btn-outline-light rounded-0">Add New School</a>
            </div>
        </div>
        <div class="card-body rounded-0">
            <div class="table-hover">
                @if (count($schools) > 0)
                    <table class="table">
                        <thead>
                            <th class="font-weight-bold">ID</th>
                            <th class="font-weight-bold">Name</th>
                            <th class="font-weight-bold">Phyiscal Location</th>
                            <th class="font-weight-bold">Primary Contact</th>
                            <th class="font-weight-bold">Added By</th>
                            <th class="font-weight-bold">No. of Student</th>
                            <th class="font-weight-bold">No. of Teachers</th>
                            <th class="font-weight-bold">Date Added</th>
                            <th class="font-weight-bold">#</th>
                        </thead>
                        <tbody>
                            @foreach ($schools as $school)
                                <tr>
                                    <td> SCH-{{ $school->id }} </td>
                                    <td><a href="{{route('schools.show', ['school' => $school->id])}}" class="link">{{$school->Name }}</a></td>
                                    <td>{{$school->PhyiscalLocation }}</td>
                                    <td>{{$school->PrimaryContact }}</td>
                                    <td>{{$school->user->FirstName.' '.$school->user->SecondName }}</td>
                                    <td>Coming Soon</td>
                                    <td>Coming Soon</td>
                                    <td>{{$school->created_at }}</td>
                                    <td>
                                        <form action="{{ route('schools.destroy', ['school' => $school->id ]) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <input type="submit" value="Delete" class="btn btn-danger">
                                        </form>
                                        <a href="{{ route('schools.edit', ['school' => $school->id]) }}" class="btn btn-warning">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-danger">
                        <p>No schools in the System</p>
                    </div>
                @endif
                {{ $schools->links() }}
            </div>
        </div>
    </div>
@endsection
