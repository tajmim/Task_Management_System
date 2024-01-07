@extends('developer.layouts.master')


@section('content')
    <h1 class="mt-5 text-center"> Manage Projects </h1>

    
    {{-- session message print --}}
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>{{ session()->get('message') }}</strong>
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            @if (is_array(session()->get('error')))
                <div class="alert alert-danger">
                    <ul>
                        @foreach (session()->get('error') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @else
                <strong>{{ session()->get('error') }}</strong>
            @endif
        </div>
    @endif
    {{-- {{dd($errors)}} --}}
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif




    <div class="row">
        @foreach ($projects as $project)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h4><a href="{{route('developer_project_details',$project->id)}}">{{ $project->project_title }}</a></h4>
                    </div>
                    <div class="card-body">
                        {{-- <p class="card-title">This is project Description</p> --}}
                        <p class="card-text">{{ $project->project_description }}</p>
                    </div>
                    <div class="card-footer text-muted" style="display: flex;justify-content:space-between;">
                        <div class="created_by">
                            {{$project->created_by}}
                        </div>
                        <div class="date">
                            {{ $project->start_date }} - {{ $project->end_date }}
                        </div>
                        
                    </div>
                </div>
            </div>
        @endforeach



    </div>









    

@endsection
