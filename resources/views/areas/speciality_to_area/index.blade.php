@extends('_layouts.dashboard')

@section('title') Speciality to area @endsection

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Speciality to area</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{ config('app.name') }}</a></li>
                <li class="breadcrumb-item"><a href="#">Speciality to area</a></li>
                <li class="breadcrumb-item active">Index</li>
            </ol>
        </div>
    </div>

    <div class="row" id="goToAll">
        <div class="col-lg-12">
            <div class="card-box table-responsive">
                <h4 class="m-t-0 header-title">All Speciality to area</h4>
                <p class="text-muted font-14 m-b-30">
                    Here you will find all the resources to make actions on them.
                </p>

                <table data-page-length='50' id="datatable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th style="width: 15%">Area</th>
                            <th style="width: 80%">Speciality</th>
                            <th style="width: 15%">Control</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($areas as $area)
                            <tr>
                                <td>{{ $area->name_ar }}</td>
                                <td>
                                    <select name="area-{{$area->uuid}}[]" id="area-{{$area->uuid}}" multiple class="select2" data-placeholder="Choose ..." tabindex="-1" aria-hidden="true">
                                        @foreach($specialities as $key => $speciality)
                                            @if($theArea = $speciality->areas()->where('speciality_id', $speciality->id)->first())
                                                <option @if($area->id == $theArea->pivot->area_id) selected @else disabled @endif value="{{ $speciality->uuid }}">{{ $speciality->name_ar }} - (Area : {{ $theArea->name_ar }})</option>
                                            @else
                                                <option @if($speciality->id == $area->speciality_id) selected @endif value="{{ $speciality->uuid }}">{{ $speciality->name_ar }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <a @click.prevent="update('{{ $area->uuid }}')" class="btn btn-sm btn-success area-{{$area->uuid}}">
                                        Update {{ $area->name_ar }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- end row -->

@endsection

@section('scripts')
    <script>
        const app = new Vue({
            el : '#app',
            data : {
                area_uuid: '',
                specialities: {!! $specialities->toJson() !!},
                selected_specialities: {},
            },
            methods : {
                update(area_uuid){
                    addLoader();
                    this.area_uuid = area_uuid;
                    var url = '{{ url('dashboard') }}' + '/speciality-to-area/' + this.area_uuid + '/update';

                    var selected_specialities = $('#area-' + area_uuid).val();

                    axios.post(url, {specialities : selected_specialities})
                        .then((response) => {
                            removeLoarder();

                            if(response.data.message.msg_status == 1){
                                addAlert('success', response.data.message.text);
                            }else{
                                addAlert('danger', response.data.message.text);
                            }

                            window.location.reload();
                        })
                        .catch((data) => {
                            removeLoarder();
                        });

                },
            }
        });
    </script>
@endsection