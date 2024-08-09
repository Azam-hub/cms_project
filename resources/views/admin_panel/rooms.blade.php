@extends('admin_panel._layout')

@section('stylesheet')

@endsection


@section('content')

<!-- Add/Update room Modal -->
<div class="modal fade" id="room-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" enctype="multipart/form-data"> {{-- Action attribute set from JS --}}
                @csrf
                <input type="hidden" name="room_id" id="room-id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg mb-3">
                            <label for="room-name" class="form-label mb-1">Enter Room Name</label>
                            <input type="text" name="room_name" id="room-name" class="w-100 form-control shadow-sm py-2 rounded-3 border-1 {{ $errors->has('room_name') ? 'is-invalid' : 'border-dark-subtle' }}" placeholder="Enter Room Name" value="{{ old('room_name') }}">
                            <div class="text-danger">@error('room_name') {{ $message }} @enderror</div>
                        </div>
                        <div class="col-lg mb-3">
                            <label for="seats" class="form-label mb-1">Enter number of Seats</label>
                            <input type="number" name="seats" id="seats" class="w-100 form-control shadow-sm py-2 rounded-3 border-1 {{ $errors->has('seats') ? 'is-invalid' : 'border-dark-subtle' }}" placeholder="Enter number of Seats" value="{{ old('seats') }}">
                            <div class="text-danger">@error('seats') {{ $message }} @enderror</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Room</button>
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
        $msg = "Room can't be added. Try again!
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
            <h5 class="fw-semibold">Add Room</h5>
            <button class="btn btn-secondary" id="add-room-btn" data-bs-toggle="modal" data-bs-target="#room-modal">Add</button>
        </div>
    </div>
    <div class="row flex-column ">
        <div class="col">
            <h5 class="fw-semibold">Rooms</h5>
        </div>
        <div class="col">
            <div class="table-responsive">
                <table id="room-table" class="table table-striped table-bordered table-hover border-dark-subtle">
                    <thead>
                        <tr>
                            <th class="text-center">S. No.</th>
                            <th class="text-center">Rooms</th>
                            <th class="text-center">Seats</th>
                            <th class="action-btns text-center">Action</th>
                            <th class="text-center">Added On</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rooms as $room)
                            <tr>
                                <td class="text-center">{{ $count }}.</td>
                                <td class="text-center">{{ $room->name }}</td>
                                <td class="text-center">{{ $room->seats }}</td>
                                <td class="action-btns">

                                    <button class="btn btn-primary edit-btn" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#room-modal"
                                    data-room-id="{{ $room->id }}" 
                                    data-room-name="{{ $room->name }}" 
                                    data-room-seats="{{ $room->seats }}" 
                                    >Edit</button>

                                    <button class="btn btn-danger del-btn" data-room-id="{{ $room->id }}">Delete</button>

                                </td>
                                <td>{!! date('h:i a <b>||</b> d M, Y', strtotime($room->created_at)) !!}</td>
                            </tr>

                            @php $count--; @endphp
                        @empty
                            No rooms added.
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
    $('#room-table').DataTable({
        dom: 'lBfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "aaSorting": []

    });

    // On hiding modal resetting form
    $('#room-modal').on('hidden.bs.modal', function (e) {
        $(".modal form").trigger("reset");
        $("#preview_image").attr('src', "{{ asset('img/static/default_image-removebg-preview.png') }}")
    });

    // Modifying Modal for adding room
    $("#add-room-btn").click(function() {
        $(".modal-title").text("Add Room")
        $(".modal button[type=submit]").text("Add Room")
        $(".modal form").attr('action', '{{ route("admin_panel.process_addRoom") }}')

    })

    // Modifying Modal for editting admin
    $(document).on('click', ".edit-btn", function() {
        // Fetching and assigning
        let room_id = $(this).data("room-id")
        let name = $(this).data("room-name")
        let seats = $(this).data("room-seats")

        // Change modal for editting
        $(".modal-title").text("Edit Room")
        $(".modal button[type=submit]").text("Edit Room")
        $(".modal form").attr('action', `{{ route("admin_panel.process_editRoom") }}`)

        

        $('.modal input#room-id').val(room_id)
        $("#room-name").val(name)
        $("#seats").val(seats)
        

    })    

    // Delete data method
    $(document).on("click", ".del-btn", function() {
        let room_id = $(this).data("room-id")


        fetch('/admin/rooms/process_destroyRoom/'+room_id, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(function (response) {
            return response.json();
        }).then(function (data) {
            if (data.success) {
                $('button[data-room-id="' + room_id + '"]').closest('tr').remove();
            } else {
                console.log(data);
            }
        })

    })
</script>
@endsection