@extends('admin_panel._layout')


@section('stylesheet')
    
@endsection



@section('content')

<!-- Add/Update roster Modal -->
<div class="modal fade" id="roster-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" enctype="multipart/form-data"> 
                @csrf
                <input type="hidden" name="roster_id" id="roster-id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg mb-3">
                            <label for="select-teacher" class="form-label mb-1">Select Teacher</label>
                            <select name="user_id" id="select-teacher" class="w-100 form-select shadow-sm py-2 rounded-3 border-1 {{ $errors->has('teacher') ? 'is-invalid' : 'border-dark-subtle' }}">
                                <option value="">-- Select Teacher --</option>
                                @forelse ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} || {{ $user->father_name }}</option>                                        
                                @empty
                                    <option value="">No teacher added</option>                                        
                                @endforelse
                            </select>
                            <div class="text-danger">@error('room') {{ $message }} @enderror</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg mb-3">
                            <label for="select-room" class="form-label mb-1">Select Room</label>
                            <select name="room" id="select-room" class="w-100 form-select shadow-sm py-2 rounded-3 border-1 {{ $errors->has('room') ? 'is-invalid' : 'border-dark-subtle' }}">
                                <option value="">-- Select Room --</option>
                                @forelse ($rooms as $room)
                                    <option value="{{ $room->id }}">{{ $room->name }}</option>                                        
                                @empty
                                    <option value="">No room added</option>                                        
                                @endforelse
                            </select>
                            <div class="text-danger">@error('room') {{ $message }} @enderror</div>
                        </div>
                        <div class="col-lg mb-3">
                            <label for="select-timing" class="form-label mb-1">Select Timing</label>
                            <select name="timing" id="select-timing" class="w-100 form-select shadow-sm py-2 rounded-3 border-1 {{ $errors->has('timing') ? 'is-invalid' : 'border-dark-subtle' }}">
                                <option value="">-- Select Timing --</option>
                                <option value="11-12">11:00 am to 12:00 am</option>
                                <option value="12-13">12:00 am to 01:00 pm</option>
                                <option value="13-14">01:00 pm to 02:00 pm</option>
                                <option value="14-15">02:00 pm to 03:00 pm</option>
                                <option value="15-16">03:00 pm to 04:00 pm</option>
                                <option value="16-17">04:00 pm to 05:00 pm</option>
                                <option value="17-18">05:00 pm to 06:00 pm</option>
                                <option value="18-19">06:00 pm to 07:00 pm</option>
                                <option value="19-20">07:00 pm to 08:00 pm</option>
                                <option value="20-21">08:00 pm to 09:00 pm</option>
                                <option value="21-22">09:00 pm to 10:00 pm</option>
                                
                            </select>
                            <div class="text-danger">@error('timing') {{ $message }} @enderror</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Roster</button>
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
        $msg = "{}{}{}{} can't be added. Try again!
                <ul class='m-0'>";
                    foreach ($errors->all() as $error) {
                        $msg .= "<li>$error</li>";
                    }
                $msg .= "</ul>";
    @endphp
    {!! danger_msg($msg) !!}
@endif


<section class="py-3">
    {{-- <div class="row my-2 justify-content-center align-items-center">
        <div class="col-auto">
            <h3>Roster of <q class="fw-bolder">{{ $user->name }}</q></h3>
        </div>
    </div> --}}
    <div class="row mb-4">
        <div class="col">
            <h5 class="fw-semibold">Add roster</h5>
            <button class="btn btn-secondary" id="add-roster-btn" data-bs-toggle="modal" data-bs-target="#roster-modal">Add</button>
        </div>
    </div>
    <div class="row flex-column ">
        <div class="col">
            <h5 class="fw-semibold">Rosters</h5>
        </div>
        <div class="col">
            <div class="table-responsive">
                <table id="roster-table" class="table table-striped table-bordered table-hover border-dark-subtle">
                    <thead>
                        <tr>
                            <td class="search-row-1">S. No.</td>
                            <td class="search-row-2">Name</td>
                            <td class="search-row-3">Room</td>
                            <td class="search-row-4">Timing</td>
                            <td class="search-row-5">Action</td>
                            <td class="search-row-6">Added On</td>
                        </tr>
                        <tr>
                            <th class="text-center">S. No.</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Room</th>
                            <th class="text-center">Timing</th>
                            <th class="action-btns text-center">Action</th>
                            <th class="text-center">Added On</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rosters as $roster)
                            <tr data-admin-id="{{ $roster->admin_id }}">
                                <td class="text-center">{{ $rosters_count }}.</td>
                                <td class="text-center">{{ $roster->user->name }}</td>
                                <td class="text-center">{{ $roster->room->name }}</td>
                                <td class="text-center">{{ \DateTime::createFromFormat('G', explode('-', $roster->timing)[0])->format('h:i a') . ' to ' . \DateTime::createFromFormat('G', explode('-', $roster->timing)[1])->format('h:i a') }}</td>
                                <td class="action-btns">

                                    <button class="btn btn-primary edit-btn" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#roster-modal"
                                    data-roster-id="{{ $roster->id }}" 
                                    data-user-id="{{ $roster->admin_id }}" 
                                    data-roster-room="{{ $roster->room->id }}" 
                                    data-roster-timing="{{ $roster->timing }}" 
                                    >Edit</button>

                                    <button class="btn btn-danger del-btn" data-roster-id="{{ $roster->id }}">Delete</button>

                                </td>
                                <td>{!! date('h:i a <b>||</b> d M, Y', strtotime($roster->created_at)) !!}</td>
                            </tr>

                            @php $rosters_count--; @endphp
                        @empty
                            No rosters added.
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
$('#roster-table').DataTable({
    initComplete: function () {
        let i = 1;
        this.api()
            .columns()
            .every(function () {
                var column = this;
                var title = column.header().textContent;

                // Create input element and add event listener
                $('<input type="text" placeholder="Search ' + title + '" />')
                    .appendTo($(`.search-row-${i}`).empty())
                    .on('keyup change clear', function () {
                        if (column.search() !== this.value) {
                            column.search(this.value).draw();
                        }
                    });

                i++;
            });
        // console.log(this.api().column("#shift"))
    },
    dom: 'lBfrtip',
    buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
    ],
    "aaSorting": []

});


// On hiding modal resetting form
$('#roster-modal').on('hidden.bs.modal', function (e) {
    $(".modal form").trigger("reset");
});

// Modifying Modal for adding roster
$("#add-roster-btn").click(function() {
    $(".modal-title").text("Add Roster")
    $(".modal button[type=submit]").text("Add Roster")
    $(".modal form").attr('action', '{{ route("admin_panel.process_addRoster") }}')

})

// Modifying Modal for editting admin
$(document).on('click', ".edit-btn", function() {
    // Fetching and assigning
    let roster_id = $(this).data("roster-id")
    let user_id = $(this).data("user-id")
    let room = $(this).data("roster-room")
    let timing = $(this).data("roster-timing")

    // Change modal for editting
    $(".modal-title").text("Edit Roster")
    $(".modal button[type=submit]").text("Edit Roster")
    $(".modal form").attr('action', `{{ route("admin_panel.process_editRoster") }}`)

    

    $('.modal input#roster-id').val(roster_id)
    $('#select-teacher').val(user_id)
    $("#select-room").val(room)
    $("#select-timing").val(timing)
    

})    

// Delete data method
$(document).on("click", ".del-btn", function() {
    let roster_id = $(this).data("roster-id")


    fetch('/admin/rosters/process_destroyRoster/'+roster_id).then(function (response) {
        return response.json();
    }).then(function (data) {
        if (data.success) {
            $('button[data-roster-id="' + roster_id + '"]').closest('tr').remove();
        } else {
            console.log(data);
        }
    })

})


// Show admin roster
$(document).on("dblclick", "table tr", function(evt){
    if($(evt.target).closest('.action-btns').length) {
        return;             
    }
    let admin_id = $(this).data("admin-id");
    if (admin_id != undefined) {
        window.open(`/admin/rosters/${admin_id}`, '_blank');
    }
});
</script>
@endsection

