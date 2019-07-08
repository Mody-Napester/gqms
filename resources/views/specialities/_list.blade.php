<table data-page-length='50' id="datatable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>Id</th>
        <th>Name ar</th>
        <th>Name en</th>
        <th>Created at</th>
    </tr>
    </thead>

    <tbody>
        @foreach($specialities as $speciality)
            <tr>
                <td>{{ $speciality->id }}</td>
                <td>{{ $speciality->name_ar }}</td>
                <td>{{ $speciality->name_en }}</td>
                <td>{{ $speciality->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>