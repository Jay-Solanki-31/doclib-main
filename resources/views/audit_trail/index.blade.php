@extends('layouts.app')

@section('content')
    <div class="card card-secondary container p-0">
        <div class="card-header">
            <div class="row">
                <h4 class="col-md-10">Audit Trail</h4>
            </div>
        </div>
        <div class="card-body">
            <div class="table-hover">
                @if (count($audit_trail) > 0)
                    <table class="table">
                        <thead>
                            <th>#</th>
                            <th>ACTION</th>
                            <th>USER</th>
                            <th>DATE/ TIME</th>
                        </thead>
                        <tbody>
                            @php
                                $counter = 1;
                            @endphp
                            @foreach ($audit_trail as $record)
                                <tr>
                                    <td>{{ $counter }}</td>
                                    <td>{{ $record->action }}</td>
                                    <td>{{ $record->user->FirstName }} {{ $record->user->SecondName }}</td>
                                    <td>{{ $record->created_at->setTimezone('Africa/Nairobi') }}</td>
                                </tr>
                                @php
                                    ++$counter;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-danger">
                        <p>No Audit Record in the System</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection