<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <!--- Divider -->
        <div id="sidebar-menu">
            <ul>
                @if (\App\User::hasAuthority('use.dashboard'))
                    <li class="has_sub">
                        {{--({{ session()->get('language') }})--}}
                        <a href="{{ route('dashboard.index') }}" class="waves-effect"><i class="ti-dashboard"></i> <span> {{ trans('sidebar.Dashboard') }}</span></a>
                    </li>
                @endif

                @if (\App\User::hasAuthority('use.get_my_ip'))
                    <li class="has_sub">
                        <a href="{{ route('ip.get') }}" target="_blank" class="waves-effect"><i class="ti-location-pin"></i> <span> {{ trans('sidebar.Get_my_IP') }} </span></a>
                    </li>
                @endif

                @if (\App\User::hasAuthority('use.security'))
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
                            @if (\App\User::hasAuthority('index.roles'))
                                <li><a href="{{ route('roles.index') }}">Roles</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif
                @endif

                @if (\App\User::hasAuthority('use.resources'))
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
                    @if (\App\User::hasAuthority('index.areas'))
                        <li class="has_sub">
                            <a href="{{ route('areas.index') }}" class="waves-effect"><i class="ti-announcement"></i> <span> Reception Areas </span></a>
                        </li>
                    @endif
                    @if (\App\User::hasAuthority('index.desks'))
                        <li class="has_sub">
                            <a href="{{ route('desks.index') }}" class="waves-effect"><i class="ti-harddrives"></i> <span> Desks </span></a>
                        </li>
                    @endif
                    @if (\App\User::hasAuthority('index.rooms'))
                        <li class="has_sub">
                            <a href="{{ route('rooms.index') }}" class="waves-effect"><i class="ti-heart"></i> <span> Rooms </span></a>
                        </li>
                    @endif
                    @if (\App\User::hasAuthority('index.screens'))
                    <li class="has_sub">
                        <a href="{{ route('screens.index') }}" class="waves-effect"><i class="ti-desktop"></i> <span> Screens </span></a>
                    </li>
                    @endif
                    @if (\App\User::hasAuthority('index.printers'))
                    <li class="has_sub">
                        <a href="{{ route('printers.index') }}" class="waves-effect"><i class="ti-printer"></i> <span> Printers </span></a>
                    </li>
                    @endif

                    @if (\App\User::hasAuthority('use.ganzory_resources'))
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="ti-home"></i> <span> Ganzory Resources </span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                                <li><a href="{{ route('clinics.index') }}">Clinics</a></li>
                                <li><a href="{{ route('specialities.index') }}">Specialities</a></li>
                                <li><a href="{{ route('doctors.index') }}">Doctors</a></li>
                                <li><a href="{{ route('patients.index') }}">Patients</a></li>
                                <li><a href="{{ route('reservations.index') }}">Reservations</a></li>
                                <li><a href="{{ route('schedules.index') }}">Schedules</a></li>
                            </ul>
                        </li>
                    @endif

                @endif

                    @if (\App\User::hasAuthority('use.queues'))
                        <li class="text-muted menu-title">Queues</li>
                        @if (\App\User::hasAuthority('use.all_queue_history'))
                            <li class="has_sub">
                                <a href="{{ route('queues.queuesHistory') }}" class="waves-effect"><i class="ti-server"></i> <span> Queues History</span></a>
                            </li>
                        @endif

                        @if (!is_null(auth()->user()->desk_id) && auth()->user()->login_ip == auth()->user()->desk->ip)
                             @if (\App\User::hasAuthority('use.desk_queue'))
                                <li class="has_sub">
                                    <a href="{{ route('desks.show', [auth()->user()->desk->uuid]) }}" class="waves-effect"><i class="ti-exchange-vertical"></i> <span> {{ trans('sidebar.Desk_queue') }} </span></a>
                                </li>
                             @endif
                        @endif

                        @if (\App\User::hasAuthority('use.desk_queue_history'))
                            <li class="has_sub">
                                <a href="{{ route('desks.queues.deskQueueHistory') }}" class="waves-effect"><i class="ti-server"></i> <span> Desk queue History</span></a>
                            </li>
                        @endif

                        @if (!is_null(auth()->user()->room_id) && auth()->user()->login_ip == auth()->user()->room->ip)
                             @if (\App\User::hasAuthority('use.doctor_queue'))
                                <li class="has_sub">
                                    <a href="{{ route('rooms.show', [auth()->user()->room->uuid]) }}" class="waves-effect"><i class="ti-exchange-vertical"></i> <span> {{ trans('sidebar.Doctors_queue') }} </span></a>
                                </li>
                             @endif
                        @endif

                        @if (\App\User::hasAuthority('use.doctor_queue_history'))
                            <li class="has_sub">
                                <a href="{{ route('rooms.queues.roomQueueHistory') }}" class="waves-effect"><i class="ti-server"></i> <span> Doctors queue History</span></a>
                            </li>
                        @endif
                    @endif


                @if (\App\User::hasAuthority('use.settings'))
                    <li class="text-muted menu-title">Settings</li>
                    {{--<li class="has_sub">--}}
                        {{--<a href="{{ route('doctor-to-floor.index') }}" class="waves-effect"><i class="ti-bookmark"></i> <span> Doctor to floors</span></a>--}}
                    {{--</li>--}}
                    @if (\App\User::hasAuthority('update.speciality_to_area'))
                        <li class="has_sub">
                            <a href="{{ route('areas.getSpecialityToArea') }}" class="waves-effect"><i class="ti-layers"></i> <span> Speciality to area</span></a>
                        </li>
                    @endif
                    @if (\App\User::hasAuthority('use.translations'))
                        <li class="has_sub">
                            <a href="{{ url('translations') }}" class="waves-effect"><i class="ti-flag-alt-2"></i> <span> Translations </span></a>
                        </li>
                    @endif
                    @if (\App\User::hasAuthority('index.settings'))
                        <li class="has_sub">
                            <a href="{{ route('settings.index') }}" class="waves-effect"><i class="ti-settings"></i> <span> Settings </span></a>
                        </li>
                    @endif
                @endif

                @if (\App\User::hasAuthority('use.logs'))
                    <li class="text-muted menu-title">Logs</li>
                    @if (\App\User::hasAuthority('index.logs_user_logins'))
                        <li class="has_sub">
                            <a href="{{ route('logs_user_logins.index') }}" class="waves-effect"><i class="ti-layers"></i> <span> User logins</span></a>
                        </li>
                    @endif
                    @if (\App\User::hasAuthority('index.logs_user_actions'))
                        <li class="has_sub">
                            <a href="{{ route('logs_user_actions.index') }}" class="waves-effect"><i class="ti-layers"></i> <span> User actions</span></a>
                        </li>
                    @endif
                @endif

                @if (\App\User::hasAuthority('use.reports'))
                    <li class="text-muted menu-title">Reports</li>
                    @if (\App\User::hasAuthority('index.desks_reports'))
                        <li class="has_sub">
                            <a href="{{ route('reports.desks.index') }}" class="waves-effect"><i class="ti-clipboard"></i> <span> Desks Reports</span></a>
                        </li>
                    @endif
                    @if (\App\User::hasAuthority('index.doctors_reports'))
                        <li class="has_sub">
                            <a href="{{ route('reports.doctors.index') }}" class="waves-effect"><i class="ti-clipboard"></i> <span> Doctors Reports</span></a>
                        </li>
                    @endif
                @endif

            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>