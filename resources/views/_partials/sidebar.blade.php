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
                    <li class="text-muted menu-title">{{ trans('sidebar.Security') }}</li>
                    @if (\App\User::hasAuthority('use.authorizations'))
                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="ti-home"></i> <span> {{ trans('sidebar.Authorization') }} </span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            @if (\App\User::hasAuthority('index.permission_groups'))
                                <li><a href="{{ route('permission-groups.index') }}">{{ trans('sidebar.Permission_Groups') }}</a></li>
                            @endif
                            @if (\App\User::hasAuthority('index.permissions'))
                                <li><a href="{{ route('permissions.index') }}">{{ trans('sidebar.Permissions') }}</a></li>
                            @endif
                            @if (\App\User::hasAuthority('index.roles'))
                                <li><a href="{{ route('roles.index') }}">{{ trans('sidebar.Roles') }}</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif
                @endif

                @if (\App\User::hasAuthority('use.resources'))
                    <li class="text-muted menu-title">{{ trans('sidebar.Resources') }}</li>

                    @if (\App\User::hasAuthority('index.users'))
                        <li class="has_sub">
                            <a href="{{ route('users.index') }}" class="waves-effect"><i class="ti-user"></i> <span> {{ trans('sidebar.Users') }} </span></a>
                        </li>
                    @endif
                    @if (\App\User::hasAuthority('index.floors'))
                        <li class="has_sub">
                            <a href="{{ route('floors.index') }}" class="waves-effect"><i class="ti-direction"></i> <span> {{ trans('sidebar.Floors') }} </span></a>
                        </li>
                    @endif
                    @if (\App\User::hasAuthority('index.areas'))
                        <li class="has_sub">
                            <a href="{{ route('areas.index') }}" class="waves-effect"><i class="ti-announcement"></i> <span> {{ trans('sidebar.Reception_Areas') }} </span></a>
                        </li>
                    @endif
                    @if (\App\User::hasAuthority('index.desks'))
                        <li class="has_sub">
                            <a href="{{ route('desks.index') }}" class="waves-effect"><i class="ti-harddrives"></i> <span> {{ trans('sidebar.Desks') }} </span></a>
                        </li>
                    @endif
                    @if (\App\User::hasAuthority('index.rooms'))
                        <li class="has_sub">
                            <a href="{{ route('rooms.index') }}" class="waves-effect"><i class="ti-heart"></i> <span> {{ trans('sidebar.Rooms') }} </span></a>
                        </li>
                    @endif
                    @if (\App\User::hasAuthority('index.screens'))
                    <li class="has_sub">
                        <a href="{{ route('screens.index') }}" class="waves-effect"><i class="ti-desktop"></i> <span> {{ trans('sidebar.Screens') }} </span></a>
                    </li>
                    @endif
                    @if (\App\User::hasAuthority('index.printers'))
                    <li class="has_sub">
                        <a href="{{ route('printers.index') }}" class="waves-effect"><i class="ti-printer"></i> <span> {{ trans('sidebar.Printers') }} </span></a>
                    </li>
                    @endif

                    @if (\App\User::hasAuthority('use.ganzory_resources'))
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="ti-home"></i> <span> {{ trans('sidebar.Ganzory_Resources') }} </span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                                <li><a href="{{ route('clinics.index') }}">{{ trans('sidebar.Clinics') }}</a></li>
                                <li><a href="{{ route('specialities.index') }}">{{ trans('sidebar.Specialities') }}</a></li>
                                <li><a href="{{ route('doctors.index') }}">{{ trans('sidebar.Doctors') }}</a></li>
                                <li><a href="{{ route('patients.index') }}">{{ trans('sidebar.Patients') }}</a></li>
                                <li><a href="{{ route('reservations.index') }}">{{ trans('sidebar.Reservations') }}</a></li>
                                <li><a href="{{ route('schedules.index') }}">{{ trans('sidebar.Schedules') }}</a></li>
                            </ul>
                        </li>
                    @endif

                @endif

                    @if (\App\User::hasAuthority('use.queues'))
                        <li class="text-muted menu-title">{{ trans('sidebar.Queues') }}</li>
                        @if (\App\User::hasAuthority('use.all_queue_history'))
                            <li class="has_sub">
                                <a href="{{ route('queues.queuesHistory') }}" class="waves-effect"><i class="ti-server"></i> <span> {{ trans('sidebar.Queues_History') }}</span></a>
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
                                <a href="{{ route('desks.queues.deskQueueHistory') }}" class="waves-effect"><i class="ti-server"></i> <span> {{ trans('sidebar.Desk_queue_History') }}</span></a>
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
                                <a href="{{ route('rooms.queues.roomQueueHistory') }}" class="waves-effect"><i class="ti-server"></i> <span> {{ trans('sidebar.Doctors_queue_History') }}</span></a>
                            </li>
                        @endif
                    @endif


                @if (\App\User::hasAuthority('use.settings'))
                    <li class="text-muted menu-title">{{ trans('sidebar.Settings') }}</li>
                    {{--<li class="has_sub">--}}
                        {{--<a href="{{ route('doctor-to-floor.index') }}" class="waves-effect"><i class="ti-bookmark"></i> <span> Doctor to floors</span></a>--}}
                    {{--</li>--}}
                    @if (\App\User::hasAuthority('update.speciality_to_area'))
                        <li class="has_sub">
                            <a href="{{ route('areas.getSpecialityToArea') }}" class="waves-effect"><i class="ti-layers"></i> <span> {{ trans('sidebar.Speciality_to_area') }} </span></a>
                        </li>
                    @endif
                    @if (\App\User::hasAuthority('use.translations'))
                        <li class="has_sub">
                            <a href="{{ url('translations') }}" class="waves-effect"><i class="ti-flag-alt-2"></i> <span> {{ trans('sidebar.Translations') }} </span></a>
                        </li>
                    @endif
                    @if (\App\User::hasAuthority('index.settings'))
{{--                        <li class="has_sub">--}}
{{--                            <a href="{{ route('settings.index') }}" class="waves-effect"><i class="ti-settings"></i> <span> {{ trans('sidebar.Settings') }} </span></a>--}}
{{--                        </li>--}}
                    @endif
                @endif

                @if (\App\User::hasAuthority('use.logs'))
                    <li class="text-muted menu-title">{{ trans('sidebar.Logs') }}</li>
                    @if (\App\User::hasAuthority('index.logs_user_logins'))
                        <li class="has_sub">
                            <a href="{{ route('logs_user_logins.index') }}" class="waves-effect"><i class="ti-layers"></i> <span> {{ trans('sidebar.User_logins') }}</span></a>
                        </li>
                    @endif
                    @if (\App\User::hasAuthority('index.logs_user_actions'))
                        <li class="has_sub">
                            <a href="{{ route('logs_user_actions.index') }}" class="waves-effect"><i class="ti-layers"></i> <span> {{ trans('sidebar.User_actions') }}</span></a>
                        </li>
                    @endif
                @endif

                @if (\App\User::hasAuthority('use.reports'))
                    <li class="text-muted menu-title">{{ trans('sidebar.Reports') }}</li>
                    @if (\App\User::hasAuthority('index.desks_reports'))
                        <li class="has_sub">
                            <a href="{{ route('reports.desks.index') }}" class="waves-effect"><i class="ti-clipboard"></i> <span> {{ trans('sidebar.Desks_Reports') }}</span></a>
                        </li>
                    @endif
                    @if (\App\User::hasAuthority('index.doctors_reports'))
                        <li class="has_sub">
                            <a href="{{ route('reports.doctors.index') }}" class="waves-effect"><i class="ti-clipboard"></i> <span> {{ trans('sidebar.Doctors_Reports') }}</span></a>
                        </li>
                    @endif
                @endif

            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
