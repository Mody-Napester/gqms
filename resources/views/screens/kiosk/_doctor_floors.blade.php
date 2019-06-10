@foreach($doctors as $doctor)
    <div class="row">
        <div class="col-md-3 text-center">
            <div style="background-color: #ffffff;padding: 5px;margin: 5px;">{{ ($floor = \DB::table('doctor_to_floors')->where('doctor_id', $doctor->id)->first())? \App\Floor::getBy('id', $floor->floor_id)->name_en : '-' }}</div>
        </div>
        <div class="col-md-9">
            <div style="background-color: #ffffff;padding: 5px;margin: 5px;text-align: right;">{{ $doctor->name_ar }}</div>
        </div>
    </div>
@endforeach