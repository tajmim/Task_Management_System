@extends('manager.layouts.master')


@section('content')
    <h1 class="mt-5 text-center"> Manage Projects </h1>

    <div class="text-end my-2">
        <p class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#create_project_modal">create project</p>
    </div>


    <div class="row">

        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header">
                    <h4>Project Tilte</h4>
                </div>
                <div class="card-body">
                    <p class="card-title">This is project Description</p>
                    <p class="card-text">Text</p>
                </div>
                <div class="card-footer text-muted text-end">start date - end date</div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header">
                    <h4>Project Tilte</h4>
                </div>
                <div class="card-body">
                    <p class="card-title">This is project Description</p>
                    <p class="card-text">Text</p>
                </div>
                <div class="card-footer text-muted text-end">start date - end date</div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header">
                    <h4>Project Tilte</h4>
                </div>
                <div class="card-body">
                    <p class="card-title">This is project Description</p>
                    <p class="card-text">Text</p>
                </div>
                <div class="card-footer text-muted text-end">start date - end date</div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header">
                    <h4>Project Tilte</h4>
                </div>
                <div class="card-body">
                    <p class="card-title">This is project Description</p>
                    <p class="card-text">Text</p>
                </div>
                <div class="card-footer text-muted text-end">start date - end date</div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header">
                    <h4>Project Tilte</h4>
                </div>
                <div class="card-body">
                    <p class="card-title">This is project Description</p>
                    <p class="card-text">Text</p>
                </div>
                <div class="card-footer text-muted text-end">start date - end date</div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header">
                    <h4>Project Tilte</h4>
                </div>
                <div class="card-body">
                    <p class="card-title">This is project Description</p>
                    <p class="card-text">Text</p>
                </div>
                <div class="card-footer text-muted text-end">start date - end date</div>
            </div>
        </div>

    </div>









    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div class="modal fade" id="create_project_modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
        aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">
                        Modal title
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">Body</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional: Place to the bottom of scripts -->
    <script>
        const myModal = new bootstrap.Modal(
            document.getElementById("modalId"),
            options,
        );
    </script>
@endsection
