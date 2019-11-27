<h4 class="m-t-20 m-b-20">{{ trans('dashboard.Logged_in_Users') }} <span class="text-info">({{ count($loggedInUsers) }})</span></h4>

<div class="card-box p-2">
    <table class="table table-striped table-bordered table-sm">
        <thead>
        <tr>
            <td>{{ trans('dashboard.User') }}</td>
            <td>{{ trans('dashboard.From') }}</td>
            <td>{{ trans('dashboard.Available') }}</td>
            <td>{{ trans('dashboard.Type') }}</td>
        </tr>
        </thead>

        <tbody>
        @foreach($loggedInUsers as $loggedInUser)
            <tr>
                <td>{{ $loggedInUser->name }}</td>
                <td>
                    @if($loggedInUser)
                        @if($loggedInUser->desk_id != null)
                            {{ ($loggedInUser->desk)? $loggedInUser->desk->name_en : '-' }}
                        @elseif($loggedInUser->room_id != null)
                            {{ ($loggedInUser->room)? $loggedInUser->room->name_en : '-' }}
                        @endif
                    @endif
                </td>
                <td>
                    @if($loggedInUser)
                        @if($loggedInUser->available == 1)
                            <span class="badge badge-success">{{ trans('dashboard.Yes') }}</span>
                        @else
                            <span class="badge badge-danger">{{ trans('dashboard.No') }}</span>
                        @endif
                    @endif
                </td>
                <td>
                    @if($loggedInUser)
                        @if($loggedInUser->type == 1)
                            <span class="badge badge-info">{{ trans('dashboard.Doctor') }}</span>
                        @else
                            <span class="badge badge-warning">{{ trans('dashboard.Desk') }}</span>
                        @endif
                    @endif
{{--                    {{ \App\Enums\UserTypes::$types[$loggedInUser->type] }}--}}
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>
</div>