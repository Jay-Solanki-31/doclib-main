@extends('layouts.app')

@section('content')
    <div class="card card-secondary container p-0 rounded-0">
        <div class="card-header bg-secondary rounded-0 text-white">
            <div class="row">
                <h4 class="col-md-10">Staff</h4>
                <a href="{{route('register')}}" class="btn btn-outline-light rounded-0">Add New Staff</a>
            </div>
        </div>
        <div class="card-body rounded-0">
            <div class="row mt-5 mb-5">
                <div class="col col-xs-12 text-center">
                    <h4>{{ $active_users }}</h4>
                    <br>
                    <span class="font-weight-bold">Active Users</span>
                </div>
                <div class="col col-xs-12 text-center">
                    <h4>{{ $blocked_users }}</h4>
                    <br>
                    <span class="font-weight-bold">Blocked Users</span>
                </div>
                <div class="col col-xs-12 text-center">
                    <h4>{{ $pending_deletion }}</h4>
                    <br>
                    <span class="font-weight-bold">Users Pending Deletion</span>
                </div>
            </div>
        <hr>
            <div class="table-hover">
                @if (count($users) > 1)
                    <table class="table">
                        <thead class="bg-secondary">
                            <th class="font-weight-bold text-white">Staff Name</th>
                            <th class="font-weight-bold text-white">Email</th>
                            <th class="font-weight-bold text-white">User Role</th>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td><a href="{{route('staff.show', ['staff' => $user->Obfuscator])}}" class="link">{{$user->user_title->TitleName.' '.$user->FirstName.' '.$user->SecondName }}</a></td>
                                    <td>{{$user->email }}</td>
                                    <td>{{$user->user_role->RoleName }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-danger">
                        <p>No users in the System</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
