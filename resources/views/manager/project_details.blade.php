@extends('manager.layouts.master')

@section('content')
    <h2 class="text-center mt-3">Project Details</h2>
    <hr>
    <div class="project-container">
        {{-- success message --}}
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>{{ session()->get('message') }}</strong>
            </div>
        @endif
        <div class="row">
            <div class="col-md-8">
                <div class="project-title">
                    <h3>Project Title : {{ $project->project_title }}</h3>
                    <h6>Project Description : {{ $project->project_description }}</h6>
                    <div>
                        <h6>Start Time : {{ $project->start_date }}</h6>
                        <h6>End Time : {{ $project->end_date }}</h6>
                    </div>

                </div>
            </div>

            <div class="col-md-4" style="border-left:1px solid gray">
                <h5 class="text-center">
                    Developers
                </h5>
                <hr>
                <form class="form-inline" action="{{ route('add_developer_to_project', $project->id) }}" method="post">
                    @csrf <!-- Laravel CSRF token, add this line if you're using Laravel -->
                    <div class="form-group d-flex mr-2">
                        <select class="form-control m-1" id="dropdown" name="developer_id">
                            @foreach ($not_assigned_developers as $developer)
                                <option value="{{ $developer->id }}">{{ $developer->name }}</option>
                            @endforeach

                        </select>
                        <button type="submit" class="btn btn-primary m-1">Add</button>
                    </div>
                </form>
                <hr>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assigned_developers as $developer)
                        <tr>
                            <td>{{$developer->name}}</td>
                            <td><a href="" class="badge bg-danger">Remove</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
