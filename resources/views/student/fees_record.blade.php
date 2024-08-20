@extends('student._layout')


@section('stylesheet')
    <!-- Light box link -->
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('title')
Fees Record
@endsection


@section('content')

<section class="py-3">

    <div class="row flex-column ">
        <div class="section">
            <div class="col">
                <div class="col">
                    <h4 class="mb-3">Fees Record</h4>
                </div>
            </div>

            <div class="col">
                <div class="table-responsive">
                    <table id="fees-table" class="table table-striped table-bordered table-hover border-dark-subtle">
                        <thead>
                            <tr>
                                {{-- <th>S. no.</th> --}}
                                <th>Purpose</th>
                                <th>Month</th>
                                <th>Description</th>
                                <th>Amount</th>
                                <th>Added on</th>
                            </tr>
                        </thead>
                        <tbody>
    
                            @forelse ($fees as $fee)
                                <tr>
                                    <td class="text-center">{{ ucfirst($fee->purpose) }}</td>
                                    <td class="text-center">{{ ($fee->month == "-") ? "-" : DateTime::createFromFormat('m-Y', $fee->month)->format('M Y') }}</td>
                                    <td class="text-center">{{ $fee->description }}</td>
                                    <td class="text-center">{{ $fee->amount }}</td>
                                    <td class="text-center w-25">{!! date('h:i a <b>||</b> d M, Y', strtotime($fee->created_at)) !!}</td>
                                </tr>
                            @empty
                                No attendance marked.
                            @endforelse
                            <!-- <tr>
                                <td colspan="3">Total:</td>
                                <td>{{ $total_paid_fees }}</td>
                                <td></td>
                            </tr> -->
                            
    
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection


@section('script')

<script>

$('#fees-table').DataTable({
    dom: 'lBfrtip',
    buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
    ],
    "aaSorting": []

});



</script>

@endsection
