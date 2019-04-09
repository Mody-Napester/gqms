<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <!--- Divider -->
        <div id="sidebar-menu">
            <ul>

                <li class="text-muted menu-title">Security</li>

                @if (\App\User::hasAuthority('use.authorizations'))
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-home"></i> <span> Authorization </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        @if (\App\User::hasAuthority('index.permission_groups'))
                            <li><a href="{{ route('permission-groups.index') }}">Permission Groups</a></li>
                        @endif
                        @if (\App\User::hasAuthority('index.permissions'))
                            <li><a href="{{ route('permissions.index') }}">Permissions</a></li>
                        @endif
                        @if (\App\User::hasAuthority('index.authorizations'))
                            <li><a href="{{ route('roles.index') }}">Roles</a></li>
                        @endif
                    </ul>
                </li>
                @endif

                <li class="text-muted menu-title">Resources</li>
                @if (\App\User::hasAuthority('index.users'))
                    <li class="has_sub">
                        <a href="{{ route('users.index') }}" class="waves-effect"><i class="ti-user"></i> <span> Users </span></a>
                    </li>
                @endif
                @if (\App\User::hasAuthority('index.floors'))
                    <li class="has_sub">
                        <a href="{{ route('floors.index') }}" class="waves-effect"><i class="ti-direction"></i> <span> Floors </span></a>
                    </li>
                @endif
                @if (\App\User::hasAuthority('index.desks'))
                    <li class="has_sub">
                        <a href="{{ route('desks.index') }}" class="waves-effect"><i class="ti-harddrives"></i> <span> Desks </span></a>
                    </li>
                @endif

                {{--<li class="has_sub">--}}
                    {{--<a href="{{ route('users.index') }}" class="waves-effect"><i class="ti-user"></i> <span> Patients </span></a>--}}
                {{--</li>--}}
                {{--<li class="has_sub">--}}
                    {{--<a href="{{ route('users.index') }}" class="waves-effect"><i class="ti-user"></i> <span> Doctors </span></a>--}}
                {{--</li>--}}
                {{--<li class="has_sub">--}}
                    {{--<a href="{{ route('users.index') }}" class="waves-effect"><i class="ti-user"></i> <span> Receptions </span></a>--}}
                {{--</li>--}}

                <li class="has_sub">
                    <a href="{{ route('screens.index') }}" class="waves-effect"><i class="ti-desktop"></i> <span> Screens </span></a>
                </li>

                <li class="text-muted menu-title">Queues</li>
                <li class="has_sub">
                    <a href="{{ route('screens.index') }}" class="waves-effect"><i class="ti-exchange-vertical"></i> <span> Reception queue </span></a>
                </li>
                <li class="has_sub">
                    <a href="{{ route('screens.index') }}" class="waves-effect"><i class="ti-exchange-vertical"></i> <span> Doctors queue </span></a>
                </li>

                <li class="text-muted menu-title">Settings</li>
                <li class="has_sub">
                    <a href="{{ url('translations') }}" class="waves-effect"><i class="ti-flag-alt-2"></i> <span> Translations </span></a>
                </li>
                <li class="has_sub">
                    <a href="{{ url('translations') }}" class="waves-effect"><i class="ti-id-badge"></i> <span> Tickets </span></a>
                </li>

            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>