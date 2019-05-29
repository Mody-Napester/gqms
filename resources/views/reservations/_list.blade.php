<table id="datatable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>Id</th>
        <th>Clinic</th>
        <th>Doctor</th>
        <th>Desk queue</th>
        <th>Serial</th>
        <th>Patient</th>
        <th>Queue number</th>
        <th>Created at</th>
    </tr>
    </thead>

    <tbody>
        @foreach($reservations as $reservation)
            <tr>
                <td>{{ $reservation->id }}</td>
                <td>{{ ($reservation->clinic)? $reservation->clinic->name_en : '-' }}</td>
                <td>{{ ($reservation->doctor)? $reservation->doctor->name_en : '-' }}</td>
                <td>{{ ($reservation->desk_queue_id)? 'Served' : '' }}</td>
{{--                <td>{{ $reservation->desk_queue_id }}</td>--}}
                <td>{{ $reservation->source_reservation_serial }}</td>
                <td>{{ ($reservation->patient)? $reservation->patient->name_en : '' }}</td>
                <td>{{ $reservation->source_queue_number }}</td>
                <td>{{ $reservation->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>