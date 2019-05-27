<table id="datatable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>#</th>
        <th>Name ar</th>
        <th>Name en</th>
        <th>Gander</th>
        <th>Work status</th>
        <th>Created at</th>
    </tr>
    </thead>

    <tbody>
        @foreach($doctors as $key => $doctor)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $doctor->name_ar }}</td>
                <td>{{ $doctor->name_en }}</td>
                <td>{{ $doctor->gander }}</td>
                <td>{{ $doctor->workstatus }}</td>
                <td>{{ $doctor->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>