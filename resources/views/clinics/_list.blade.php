<table data-page-length='50' id="datatable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>Id</th>
        <th>Source clinic id</th>
        <th>Name ar</th>
        <th>Name en</th>
        <th>Created at</th>
    </tr>
    </thead>

    <tbody class="">
        @foreach($clinics as $clinic)
            <tr>
                <td>{{ $clinic->id }}</td>
                <td>{{ $clinic->source_clinic_id }}</td>
                <td>{{ $clinic->name_ar }}</td>
                <td>{{ $clinic->name_en }}</td>
                <td>{{ $clinic->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>