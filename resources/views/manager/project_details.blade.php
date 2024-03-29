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
                <div class="project-details">
                    <h3>Project Title : {{ $project->project_title }}</h3>
                    <h6>Project Description : {{ $project->project_description }}</h6>
                    <div>
                        @php
                            $endDate = \Carbon\Carbon::parse($project->end_date);
                        @endphp
                        <h6>Start Time : {{ $project->start_date }}</h6>
                        <h6>End Time : {{ $project->end_date }}</h6>
                        <h6>Time left : {{ $project->end_date }} ({{ $endDate->diffInDays(now()) }} days left)
                        </h6>
                    </div>
                    <hr>
                    <h3 class="text-center my-3">Tasks</h3>
                    <hr>
                    <div class="d-flex justify-content-end">
                        <p class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#createtaskform">
                            Create a new task</p>
                    </div>


                    <div class="accordion" id="accordionExample">
                        @foreach ($tasks as $task)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    @php
                                        $deadline = \Carbon\Carbon::parse($task->deadline);
                                    @endphp
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse{{ $task->id }}" aria-expanded="false"
                                        aria-controls="collapse{{ $task->id }}">

                                        <div>Task {{ $loop->iteration }}: {{ $task->task_name }} </div>
                                        <div style="margin-left:10px ; color:gray">( {{ $deadline->diffInDays(now()) }}
                                            Days left)
                                            <span
                                                class="badge {{ $task->status == 'pending' ? 'bg-danger' : '' }}{{ $task->status == 'accepted' ? 'bg-success' : '' }}{{ $task->status == 'completed' ? 'bg-primary' : '' }}">
                                                {{ $task->status }}
                                            </span>
                                        </div>



                                    </button>
                                </h2>
                                <div id="collapse{{ $task->id }}" class="accordion-collapse collapse"
                                    aria-labelledby="heading{{ $task->id }}" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <h6>Assigned To: {{$task->developer_name}}</h6>
                                        <p>{{ $task->task_description }} </p>
                                        

                                    </div>


                                </div>
                            </div>
                        @endforeach


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
                                <td>{{ $developer->name }}</td>
                                <td><a href="{{ route('remove_developers_from_project', ['p_id' => $project->id, 'd_id' => $developer->id]) }}"
                                        onclick="return confirm('Are you sure you want to remove?')"
                                        class="badge bg-danger">Remove</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if (count($assigned_developers) == 0)
                    <p class="text-muted text-center">No developers</p>
                @endif
            </div>
        </div>
    </div>





    <!-- Modal for add task -->
    <div class="modal fade" id="createtaskform" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
        aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">
                        Create a Task
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('create_task') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label style="font-weight:bold" for="title">Task Name</label>
                            <input type="text" class="form-control" id="task_name" aria-describedby="task_name"
                                placeholder="Add Task Name" name="task_name">
                        </div>
                        <div class="form-group mb-3">
                            <label style="font-weight:bold" for="task_description">Task Description</label>
                            <textarea class="form-control" name="task_description" id="task_description" rows="5"
                                placeholder="Enter task description"></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label style="font-weight:bold" for="assigned_to">Assigned To</label>
                            <select class="form-control m-1" id="dropdown" name="developer_id">
                                @foreach ($assigned_developers as $developer)
                                    <option value="{{ $developer->id }}">{{ $developer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label style="font-weight:bold" for="desc">Deadline</label>
                            <input type="text" class="form-control datepicker" id="deadline"
                                aria-describedby="deadline" name="deadline">
                        </div>

                        <input type="hidden" name="project_id" value="{{ $project->id }}">

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection
