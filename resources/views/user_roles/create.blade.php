@extends('layouts.app')

@section('content')
<div class="container">

    <h1 class="text-success font-weight-bold">
        <i class="far fa-plus-square mr-3"></i>
        <span class="text-secondary">NEW USER ROLE</span>
    </h1>

    <div class="row mt-5">
        <div class="col-md-12">
            <form action="{{ route('user-roles.store') }}" method="POST">

                {{ csrf_field() }}

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="RoleName" class="text-secondary font-weight-bold">Role Name</label>
                            <input name="RoleName" id="RoleName" class="form-control" type="text" placeholder="E.g Guest">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="Description" class="text-secondary font-weight-bold">Description</label>
                            <textarea rows="5" type="text" name="Description" placeholder="Type The Description" class="form-control rounded-0">
                            </textarea>
                        </div>
                    </div>
                </div>
                {{-- <a href="#" id="add-option" style="font-size: 25px;" title="Add Another Option"><i class="far fa-plus-square mr-3"></i></a> --}}
                <div class="row">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success btn-block rounded-0">Submit</button>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('user-roles.index') }}" class="btn btn-outline-secondary btn-block rounded-0">Back</a>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
