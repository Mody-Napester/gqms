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
                <td>
                    @if($doctor->workstatus == 0)
                        <span class="badge badge-danger"><i class="fa fa-fw fa-lock"></i></span>
                    @else
                        <span class="badge badge-success"><i class="fa fa-fw fa-unlock"></i></span>
                    @endif
                </td>
                <td>{{ $doctor->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>