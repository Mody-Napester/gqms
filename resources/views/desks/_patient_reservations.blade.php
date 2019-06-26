@foreach($reservations as $reservation)
    <div class="patient_reservation" style="padding-bottom: 10px;margin-bottom: 10px;">
        <table class="table table-sm table-striped table-bordered">
            <tr>
                <td>Serial</td>
                <td>{{ $reservation['serial'] }}</td>
                <td>Doctor</td>
                <td>{{ $reservation['doctor'] }}</td>
            </tr>
            <tr>
                <td>Patient</td>
                <td>{{ $reservation['patient'] }}</td>
                <td>Clinic</td>
                <td>{{ $reservation['clinic'] }}</td>
            </tr>

            @if($reservation['room'] == 1)
            <tr>
                <td colspan="4">
                    <div class="text-right">
                        <button class="btn btn-primary data-reservation" id="{{ $reservation['serial'] }}"><i class="fa fa-fw fa-save"></i> Confirm</button>
                    </div>
                </td>
            </tr>
            @endif
        </table>
    </div>
@endforeach