@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-success font-weight-bold">
        {{-- <i class="fas fa-book mr-3"></i> --}}
        <span class="text-secondary">System User Roles</span>
    </h1>

    <div class="row mt-5 mb-5">
        <div class="col-md-2">
            <div class="card border-0">
                <div class="card-body p-0">
                    <h6 class="text-secondary font-weight-bold">Total</h6>
                    <h3 class="text-success">{{ count($user_roles) }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <form action="" method="post">

                {{ csrf_field() }}

                <div class="form-group">
                    <input type="text" class="form-control rounded-0" name="search_tenders" placeholder="Search question" required>
                </div>
            </form>
        </div>
        <div class="col-md-2 offset-md-6">
            <a href="{{ route('user-roles.create') }}" class="btn btn-outline-success btn-block rounded-0">New User Roles</a>
        </div>
    </div>
</div>
<div class="container">
    <div class="mb-3 mt-3">
        <div class="card border-0 rounded-0 mt-3">
            <div class="card-header bg-dark text-success rounded-0">
                <div class="row">
                    <div class="col-md-1 font-weight-bold">ID</div>
                    <div class="col-md-2 font-weight-bold">ROLE NAME</div>
                    <div class="col-md-4 font-weight-bold">DESCRIPTION</div>
                    <div class="col-md-2 font-weight-bold">CREATED BY</div>
                    <div class="col-md-2 font-weight-bold">DATE ADDED</div>
                    <div class="col-md-1">#</div>
    
                    </div>
                </div>
            </div>
        </div>
        
        @if (count($user_roles) > 0)
            @foreach ($user_roles as $user_role)
                <div class="card rounded-0">
                    <div class="card-body p-2">
                        <div class="row">
                            <div class="col-md-1">
                                ROL-{{$user_role->id}}
                            </div>
                            <div class="col-md-2">
                                {{$user_role->RoleName}}
                            </div>
                            <div class="col-md-4">
                                @if (isset($user_role->Description))
                                    {{$user_role->Description}}
                                @else
                                    N/A                                
                                @endif
                            </div>
                            <div class="col-md-2">
                                @if (isset($user_role->user))
                                    {{$user_role->user->FirstName.' '.$user_role->user->SecondName}}
                                @else
                                    System
                                @endif
                                
                            </div>
                            <div class="col-md-2">
                                {{$user_role->created_at}}
                            </div>
                            <div class="col-md-1">
                                <form action="{{ route('user-roles.destroy', $user_role->id) }}" method="post">
                                        @method('DELETE')
                                        {{ csrf_field() }}
    
                                        <button type="submit" style="border:none; background:none; cursor: pointer;"><i class="far fa-trash-alt"></i></button>
    
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="row">
                    <div class="col-md-4 offset-md-4 text-center">
                        {{-- {{ $user_roles->links() }} --}}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
