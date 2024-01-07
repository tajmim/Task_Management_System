@extends('developer.layouts.master')

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
                                        <h6>Assigned To: {{ $task->developer_name }}</h6>
                                        <p>{{ $task->task_description }} </p>


                                        <hr>
                                        @if ($task->assign_to == Auth::guard('developer')->user()->id)
                                            <form class="form-inline" action="{{ route('update_status_task', $task->id) }}"
                                                method="post">
                                                @csrf <!-- Laravel CSRF token, add this line if you're using Laravel -->
                                                <div class="form-group d-flex mr-2">
                                                    <select class="form-control m-1" id="dropdown" name="status">

                                                        <option value="pending">pending</option>
                                                        <option value="accepted">accepted</option>
                                                        <option value="completed">completed</option>s


                                                    </select>
                                                    <button type="submit" class="btn btn-primary m-1">Update</button>
                                                </div>
                                            </form>
                                        @endif




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
@endsection
