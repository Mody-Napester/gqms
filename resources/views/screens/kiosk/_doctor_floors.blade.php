@if($type == 'doctor')
    @foreach($doctors as $doctor)
        <div class="row">
            <div class="col-md-2 text-center pr-0">
    {{--            <div style="background-color: #ffffff;padding: 5px;margin: 5px;">{{ ($floor = \DB::table('doctor_to_floors')->where('doctor_id', $doctor->id)->first())? \App\Floor::getBy('id', $floor->floor_id)->name_en : '-' }}</div>--}}
    {{--            <div style="background-color: #ffffff;padding: 5px;margin: 5px;">{{ ($doctor->speciality )? $doctor->speciality->id : '-' }}</div>--}}
                <div style="background-color: #ffffff;padding: 5px;margin: 5px;">
                    @if($doctor->speciality)
                        @if($area = $doctor->speciality->areas()->where('speciality_id', $doctor->speciality->id)->first())
                            {{ $area->name_en . '-' . $area->floor->name_en }}
                        @else
                            -
                        @endif
                    @else
                        -
                    @endif
                </div>
            </div>
            <div class="col-md-4 text-center pr-0 pl-0">
                <div style="background-color: #ffffff;padding: 5px;margin: 5px;">{{ ($doctor->speciality)? $doctor->speciality->name_ar : '-' }}</div>
            </div>
            <div class="col-md-6 pl-0">
                <div style="background-color: #ffffff;padding: 5px;margin: 5px;text-align: right;">{{ $doctor->name_ar }}</div>
            </div>
        </div>
    @endforeach
@else
    @foreach($specialities as $speciality)
        @foreach($speciality->doctors as $doctor)
            <div class="row text-center">
                <div class="col-md-2 pr-0">
                    <div style="background-color: #ffffff;padding: 5px;margin: 5px;">
                        @if($speciality->areas)
                            @if($area = $speciality->areas()->first())
                                {{ $area->name_en . '-' . $area->floor->name_en }}
                            @else
                                -
                            @endif
                        @else
                            -
                        @endif
                    </div>
                </div>

                <div class="col-md-6 p-0">
                    <div style="background-color: #ffffff;padding: 5px;margin: 5px;text-align: right;">{{ $doctor->name_ar }}</div>
                </div>

                <div class="col-md-4 pl-0">
                    <div style="background-color: #ffffff;padding: 5px;margin: 5px;">{{ $speciality->name_ar }}</div>
                </div>
            </div>
        @endforeach
    @endforeach
@endif