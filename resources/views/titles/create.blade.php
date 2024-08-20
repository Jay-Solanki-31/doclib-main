@extends('layouts.app')

@section('content')
<div class="container">

    <h1 class="text-success font-weight-bold">
        <i class="far fa-plus-square mr-3"></i>
        <span class="text-secondary">NEW EMPLOYEE TITLE</span>
    </h1>

    <div class="row mt-5">
        <div class="col-md-12">
            <form action="{{ route('titles.store') }}" method="POST">

                {{ csrf_field() }}

                <div class="row">
                    {{-- Title Name --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="TitleName" class="text-secondary font-weight-bold">Title Name</label>
                            <input name="TitleName" id="TitleName" class="form-control" type="text" placeholder="E.g Doctor">
                        </div>
                    </div>
                    {{-- Acrynom --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Acrynom" class="text-secondary font-weight-bold">Acrynom</label>
                            <input name="Acrynom" id="Acrynom" class="form-control" type="text" placeholder="E.g Dr.">
                        </div>
                    </div>
                </div>

                <div class="row">
                </div>
                {{-- <a href="#" id="add-option" style="font-size: 25px;" title="Add Another Option"><i class="far fa-plus-square mr-3"></i></a> --}}
                <div class="row">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success btn-block rounded-0">Submit</button>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('titles.index') }}" class="btn btn-outline-secondary btn-block rounded-0">Back</a>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
