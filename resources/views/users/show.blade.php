@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card card-default rounded-0">
            <div class="card-header bg-secondary rounded-0">
                <h4 class="text-white">{{ $user[0]->user_title->TitleName.' '.$user[0]->FirstName.' '.$user[0]->SecondName }}</h4>
            </div>
            <div class="card body rounded-0">
                <div class="container p-4">
                    <div class="row">
                        <div class="col col-md-7">
                            <img src="{{ asset('storage/pics/jj.jpg') }}" alt="{{$user[0]->FirstName}}'s Picture" class="img-responsive" style="max-width: 100px;">
                        </div>
                        <div class="col col-md-5 row">
                                @if ($user[0]->validity === 0 && $user[0]->deleted_at != NULL)
                                    <div class="col">
                                        {{-- Restore User the user --}}
                                        <form action="{{ route('restore_user', ['staff' => $user[0]->Obfuscator ]) }}" method="POST">
                                        @csrf
                                        <input type="submit" value="Restore User" class="btn btn-success rounded-0">
                                        </form>
                                    </div>

                                    <div class="col">
                                        {{-- Restore account --}}
                                        <form action="{{ route('remove_user', ['staff' => $user[0]->Obfuscator ]) }}" method="POST">
                                        @csrf
                                        <input name="_method" type="hidden" value="DELETE">
                                        <input type="submit" value="Permanently Remove User" class="btn btn-danger rounded-0">
                                        </form>
                                    </div>
                                @else
                                    <div class="col">
                                        <form action="{{ route('staff.destroy', ['staff' => $user[0]->Obfuscator ]) }}" method="POST">
                                            @csrf
                                            <input name="_method" type="hidden" value="DELETE">
                                            <input type="submit" value="Remove User" class="btn btn-outline-secondary rounded-0">
                                        </form>
                                    </div>
                                    <div class="col">
                                        @if ($user[0]->validity === 0)
                                            {{-- Button for unblocking user --}}
                                            <form action="{{route('unblock_user', ['staff' => $user[0]->Obfuscator, 'firstname' => $user[0]->FirstName, 'lastname' => $user[0]->SecondName,])}}" method="post">
                                                @csrf
                                                <input type="hidden" name="_method" value="PATCH">
                                                <input type="submit" value="Unblock User" class="btn btn-danger rounded-0">
                                            </form>

                                        @else
                                            {{-- Button for blocking user --}}
                                            <form action="{{route('block_user', ['staff' => $user[0]->Obfuscator, 'firstname' => $user[0]->FirstName, 'lastname' => $user[0]->SecondName,])}}" method="post">
                                                @csrf
                                                <input type="hidden" name="_method" value="PUT">
                                                <input type="submit" value="Block User" class="btn btn-danger rounded-0">
                                            </form>
                                        @endif
                                    </div>
                                @endif
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-6">
                            <p><span class="font-weight-bold">First Name:</span> {{$user[0]->FirstName}}</p>
                            <p><span class="font-weight-bold">Second Name:</span> {{$user[0]->SecondName}}</p>
                            <p><span class="font-weight-bold">User Role:</span> {{$user[0]->user_role->RoleName}}</p>
                            <p><span class="font-weight-bold">Status:</span> {{$user[0]->validity}}</p>
                        </div>
                        <div class="col-6">
                            <p><span class="font-weight-bold">Email:</span> {{$user[0]->email}}</p>
                            <p><span class="font-weight-bold">Gender:</span> {{$user[0]->gender}}</p>
                            <br>
                            <a href="{{ route('staff.edit', ['staff' => $user[0]->Obfuscator]) }}" class="btn btn-outline-primary rounded-0 mr-3">Edit User Details</a>
                            <a href="{{ route('staff.index') }}" class="btn btn-secondary rounded-0">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
