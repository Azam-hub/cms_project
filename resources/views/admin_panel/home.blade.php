@extends('admin_panel._layout')


@section('stylesheet')
    <link rel="stylesheet" href="{{ asset("admin_panel/css/home.css") }}">
@endsection


@section('content')
    <!-- Update Email Modal -->
    <div class="modal fade" id="update-email-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Email</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <!-- <input type="hidden" name="id">
                        <div class="fields">
                            <div class="field">
                                <label for="update-email">Enter Email</label>
                                <input type="text" name="email" id="update-email" placeholder="Enter Email">
                            </div>
                        </div> -->
                        <div class="row">
                            <div class="col px-1">
                                <label for="update-email" class="form-label">Enter Email</label>
                                <input type="email" name="email" id="update-email" class="form-control border-1 border-dark" placeholder="Enter Email">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="update-email">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Update Password Modal -->
    <div class="modal fade" id="update-password-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Email</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col px-1">
                                <label for="old-password" class="form-label mb-1">Enter Password</label>
                                <div class="position-relative">
                                    <input type="password" name="old-password" id="old-password" class="w-100 form-control shadow-sm py-2 rounded-3 border-1 border-dark-subtle" placeholder="Enter Old Password">
                                    <ion-icon name="eye-outline" class="eye cursor-pointer position-absolute top-50 end-0 translate-middle fs-4"></ion-icon>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col px-1">
                                <label for="new-password" class="form-label mb-1">Enter Password</label>
                                <div class="position-relative">
                                    <input type="password" name="new-password" id="new-password" class="w-100 form-control shadow-sm py-2 rounded-3 border-1 border-dark-subtle" placeholder="Enter New Password">
                                    <ion-icon name="eye-outline" class="eye cursor-pointer position-absolute top-50 end-0 translate-middle fs-4"></ion-icon>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col px-1">
                                <label for="confirm-new-password" class="form-label mb-1">Enter Confirm Password</label>
                                <div class="position-relative">
                                    <input type="password" name="confirm-new-password" id="confirm-new-password" class="w-100 form-control shadow-sm py-2 rounded-3 border-1 border-dark-subtle" placeholder="Re-enter New Password">
                                    <ion-icon name="eye-outline" class="eye cursor-pointer position-absolute top-50 end-0 translate-middle fs-4"></ion-icon>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="update-password">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    {{-- {{ Auth::user() }} --}}
    <section class="py-3">
        <div class="row mb-2">
            <div class="col">
                <h3 class="fw-bolder">General</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-12 mb-4">
                <h6>Update Email</h6>
                <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#update-email-modal">Update</button>
            </div>
            <div class="col-sm-6 col-12 mb-4">
                <h6>Update Password</h6>
                <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#update-password-modal">Update</button>
            </div>
        </div>

    </section>

@endsection