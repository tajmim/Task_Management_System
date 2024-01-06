@extends('manager.layouts.master')


@section('content')
    <h1 class="mt-5 text-center"> Manage Projects </h1>

    <div class="text-end my-2">
        <p class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#create_project_modal">create project</p>
    </div>
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
                        <h4><a href="{{route('project_details',$project->id)}}">{{ $project->project_title }}</a></h4>
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









    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div class="modal fade" id="create_project_modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">
                        Create a new Project
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="{{ route('create_project') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label style="font-weight:bold" for="title">Project Title</label>
                            <input type="text" class="form-control" id="title" aria-describedby="title"
                                placeholder="Project Title" name="title">
                        </div>
                        <div class="form-group mb-3">
                            <label style="font-weight:bold" for="desc">Project Description</label>
                            <textarea class="form-control" name="desc" id="desc" rows="5" placeholder="Enter project description"></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label style="font-weight:bold" for="desc">Start Date</label>
                            <input type="text" class="form-control datepicker" id="start_date"
                                aria-describedby="start_date" name="start_date">
                        </div>
                        <div class="form-group mb-3">
                            <label style="font-weight:bold" for="desc">End Date</label>
                            <input type="text" class="form-control datepicker" id="end_date"
                                aria-describedby="end_date" name="end_date">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>



@endsection
