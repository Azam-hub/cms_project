@extends('admin_panel._layout')

@section('stylesheet')

@endsection


@section('content')

<!-- Add/Update announcement Modal -->
<div class="modal fade" id="announcement-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" enctype="multipart/form-data"> {{-- Action attribute set from JS --}}
                @csrf
                <input type="hidden" name="announcement_id" id="announcement-id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg mb-3">
                            <label for="title" class="form-label mb-1 required-label">Enter Announcement Title</label>
                            <input type="text" name="title" id="title" class="w-100 form-control shadow-sm py-2 rounded-3 border-1 {{ $errors->has('title') ? 'is-invalid' : 'border-dark-subtle' }}" placeholder="Enter Title" value="{{ old('title') }}">
                            <div class="text-danger error-msg">@error('title') {{ $message }} @enderror</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg mb-3">
                            <label for="description" class="form-label mb-1 required-label">Enter Description</label>
                            <textarea name="description" id="description" class="w-100 form-control shadow-sm py-2 rounded-3 border-1 {{ $errors->has('description') ? 'is-invalid' : 'border-dark-subtle' }}" placeholder="Enter Description">{{ old('description') }}</textarea>
                            <div class="text-danger error-msg">@error('description') {{ $message }} @enderror</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@if (session('success'))
    {!! success_msg(session('success')) !!}
@elseif (session('error'))
    {!! danger_msg(session('error')) !!}
@endif

@if ($errors->any())
    @php
        $msg = "Announcement can't be added. Try again!
                <ul class='m-0'>";
                    foreach ($errors->all() as $error) {
                        $msg .= "<li>$error</li>";
                    }
                $msg .= "</ul>";
    @endphp
    {!! danger_msg($msg) !!}
@endif

<section class="py-3">
    <div class="row mb-4">
        <div class="col">
            <h5 class="fw-semibold">Add Announcement</h5>
            <button class="btn btn-secondary" id="add-announcement-btn" data-bs-toggle="modal" data-bs-target="#announcement-modal">Add</button>
        </div>
    </div>
    <div class="row flex-column ">
        <div class="col">
            <h5 class="fw-semibold">Announcements</h5>
        </div>
        <div class="col">
            <div class="table-responsive">
                <table id="announcement-table" class="table table-striped table-bordered table-hover border-dark-subtle">
                    <thead>
                        <tr>
                            <th class="text-center">S. No.</th>
                            <th class="text-center">Title</th>
                            <th class="text-center">Description</th>
                            <th class="action-btns text-center">Action</th>
                            <th class="text-center">Added On</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($announcements as $announcement)
                            <tr>
                                <td class="text-center">{{ $count }}.</td>
                                <td class="text-center">{{ $announcement->title }}</td>
                                <td class="text-center">{{ $announcement->description }}</td>
                                <td class="text-center">

                                    <button class="btn btn-sm btn-primary edit-btn" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#announcement-modal"
                                    data-announcement-id="{{ $announcement->id }}" 
                                    data-announcement-title="{{ $announcement->title }}" 
                                    data-announcement-description="{{ $announcement->description }}" 
                                    >Edit</button>

                                    <button class="btn btn-sm btn-danger del-btn" data-announcement-id="{{ $announcement->id }}">Delete</button>

                                </td>
                                <td>{!! date('h:i a <b>||</b> d M, Y', strtotime($announcement->created_at)) !!}</td>
                            </tr>

                            @php $count--; @endphp
                        @empty
                            No announcements added.
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</section>

@endsection


@section('script')
<script>
    $('#announcement-table').DataTable({
        dom: 'lBfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "aaSorting": []

    });

    $(".modal form").submit(function (e) {
        let prevent = false;
        
        $(".error-msg").html("")
        
        $(".modal form input:not([type='hidden']), .modal form textarea").each(function(i, element) {
            if ($(element).val() == "") {
                prevent = true;
                $(element).next().html("This field is required.")
            }
        });
        
        if (prevent) {
            e.preventDefault()
        }
    })
    
    // On hiding modal resetting form
    $('#announcement-modal').on('hidden.bs.modal', function (e) {
        $(".modal form").trigger("reset");
        $(".error-msg").html("")
    });

    // Modifying Modal for adding announcement
    $("#add-announcement-btn").click(function() {
        $(".modal-title").text("Add Announcement")
        $(".modal form").attr('action', '{{ route("admin_panel.process_addAnnouncement") }}')

    })

    // Modifying Modal for editting admin
    $(document).on('click', ".edit-btn", function() {
        // Fetching and assigning
        let announcement_id = $(this).data("announcement-id")
        let title = $(this).data("announcement-title")
        let description = $(this).data("announcement-description")

        // Change modal for editting
        $(".modal-title").text("Edit Announcement")
        $(".modal form").attr('action', `{{ route("admin_panel.process_editAnnouncement") }}`)

        

        $('.modal input#announcement-id').val(announcement_id)
        $("#title").val(title)
        $("#description").val(description)
        

    })    

    // Delete data method
    $(document).on("click", ".del-btn", function() {
        let announcement_id = $(this).data("announcement-id")


        fetch('/admin/announcements/process_destroyAnnouncement/'+announcement_id)
        .then(function (response) {
            return response.json();
        })
        .then(function (data) {
            if (data.success) {
                $('button[data-announcement-id="' + announcement_id + '"]').closest('tr').remove();
            } else {
                console.log(data);
            }
        })

    })
</script>
@endsection