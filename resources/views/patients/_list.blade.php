<table id="datatable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>Id</th>
        <th>Ganz Id</th>
        <th>Name ar</th>
        <th>Name en</th>
        <th>phone</th>
        <th>Created by</th>
        <th>Created at</th>
    </tr>
    </thead>

    <tbody>
    @foreach($patients as $patient)
        <tr>
            <td>{{ $patient->id }}</td>
            <td>{{ $patient->source_patient_id }}</td>
            <td>{{ $patient->name_ar }}</td>
            <td>{{ $patient->name_en }}</td>
            <td>{{ $patient->phone }}</td>
            <td>{{ $patient->created_by }}</td>
            <td>{{ $patient->created_at }}</td>
        </tr>
    @endforeach
    </tbody>
</table>