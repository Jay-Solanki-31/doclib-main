@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-success font-weight-bold">
        {{-- <i class="fas fa-book mr-3"></i> --}}
        <span class="text-secondary">System Titles</span>
    </h1>

    <div class="row mt-5 mb-5">
        <div class="col-md-2">
            <div class="card border-0">
                <div class="card-body p-0">
                    <h6 class="text-secondary font-weight-bold">Total</h6>
                    <h3 class="text-success">{{ count($titles) }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2 offset-md-8">
            <a href="{{ route('titles.create') }}" class="btn btn-outline-success btn-block rounded-0">New Title</a>
        </div>
    </div>
</div>
<div class="container">
    <div class="mb-3 mt-3">
        <div class="card border-0 rounded-0 mt-3">
            <div class="card-header bg-dark text-success rounded-0">
                <div class="row">
                    <div class="col-md-1 font-weight-bold">ID</div>
                    <div class="col-md-2 font-weight-bold">TITLE NAME</div>
                    <div class="col-md-4 font-weight-bold">ACRYNOM</div>
                    <div class="col-md-2 font-weight-bold">DATE ADDED</div>
                    <div class="col-md-1">#</div>
    
                    </div>
                </div>
            </div>
        </div>
        
        @if (count($titles) > 0)
            @foreach ($titles as $title)
                <div class="card rounded-0">
                    <div class="card-body p-2">
                        <div class="row">
                            <div class="col-md-1">
                                TL-{{$title->id}}
                            </div>
                            <div class="col-md-2">
                                {{$title->TitleName}}
                            </div>
                            <div class="col-md-4">
                                @if ($title->Acrynom === 'N/A')
                                    N/A          
                                @else
                                    {{$title->Acrynom}}
                                @endif
                            </div>
                            <div class="col-md-2">
                                {{$title->created_at}}
                            </div>
                            <div class="col-md-1">
                                <form action="{{ route('titles.destroy', $title->id) }}" method="post">
                                        @method('DELETE')
                                        {{ csrf_field() }}
    
                                        <button type="submit" style="cursor: pointer;" class="btn btn-outline-danger btn-block rounded-0">Delete</button>
    
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="row">
                    <div class="col-md-4 offset-md-4 text-center">
                        {{-- {{ $titles->links() }} --}}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
