<h4 class="m-t-20 m-b-20">Logged in Users ({{ count($loggedInUsers) }})</h4>

<div class="card-box p-2">
    <table class="table table-striped table-bordered table-sm">
        <thead>
        <tr>
            <td>User</td>
            <td>Available</td>
            <td>Type</td>
        </tr>
        </thead>

        <tbody>
        @foreach($loggedInUsers as $loggedInUser)
            <tr>
                <td>{{ $loggedInUser->name }}</td>
                <td>
                    @if($loggedInUser->available == 1)
                        <span class="badge badge-success">Yes</span>
                    @else
                        <span class="badge badge-danger">No</span>
                    @endif
                </td>
                <td>{{ \App\Enums\UserTypes::$types[$loggedInUser->type] }}</td>
            </tr>
        @endforeach
        </tbody>

    </table>
</div>