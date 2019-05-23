@extends('_layouts.dashboard')

@section('title') Doctor To Floors @endsection

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Doctor To Floors</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{ config('app.name') }}</a></li>
                <li class="breadcrumb-item"><a href="#">Doctor To Floors</a></li>
                <li class="breadcrumb-item active">Index</li>
            </ol>

        </div>
    </div>

    {{--<div class="row">--}}
        {{--<div class="col-lg-12">--}}
            {{--<ul class="nav nav-tabs navtab-bg nav-justified">--}}
                {{--<li class="nav-item">--}}
                    {{--<a href="#searchResource" data-toggle="tab" aria-expanded="false" class="nav-link active">Search & filter</a>--}}
                {{--</li>--}}
                {{--<li class="nav-item">--}}
                    {{--<a href="#createResource" data-toggle="tab" aria-expanded="true" class="nav-link">Create new</a>--}}
                {{--</li>--}}
            {{--</ul>--}}
            {{--<div class="tab-content">--}}
                {{--<div class="tab-pane active" id="searchResource">--}}
                    {{--<h4 class="header-title m-t-0">Search</h4>--}}
                    {{--<p class="text-muted font-14 m-b-20">--}}
                        {{--Search on resource from here.--}}
                    {{--</p>--}}

                    {{--@include('floors.search')--}}
                {{--</div>--}}
                {{--<div class="tab-pane" id="createResource">--}}
                    {{--<h4 class="m-t-0 header-title">Create new floor</h4>--}}
                    {{--<p class="text-muted font-14 m-b-30">--}}
                        {{--Create new resource from here.--}}
                    {{--</p>--}}

                    {{--@include('floors.create')--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<!-- end card-box -->--}}
    {{--</div>--}}

    <div class="row" id="goToAll">
        <div class="col-lg-12">
            <div class="card-box table-responsive">
                <h4 class="m-t-0 header-title">All Doctor To Floors</h4>
                <p class="text-muted font-14 m-b-30">
                    Here you will find all the resources to make actions on them.
                </p>

                <table id="datatable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th style="width: 15%">Id</th>
                            <th style="width: 15%">Floor</th>
                            <th style="width: 55%">Doctors</th>
                            <th style="width: 15%">Control</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($floors as $floor)
                            <tr>
                                <td>{{ $floor->id }}</td>
                                <td>{{ $floor->name_en }}</td>
                                <td>
                                    <select name="floor-{{$floor->uuid}}[]" id="floor-{{$floor->uuid}}" multiple class="select2" data-placeholder="Choose ..." tabindex="-1" aria-hidden="true">
                                        @foreach($doctors as $key => $doctor)
                                            {{--<option @if($floor->floor_id == $floor->id) selected @endif value="{{ $floor->uuid }}">{{ $floor->name_en }}</option>--}}
                                            <option value="{{ $doctor->uuid }}">{{ $doctor->name_en }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <a @click.prevent="update('{{ $floor->uuid }}')" href="{{ route('doctor-to-floor.update', [$floor->uuid]) }}" class="update-modal btn btn-sm btn-success floor-{{$floor->uuid}}">
                                        Update <i class="fa fa-edit"></i>
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
                floor_uuid: '',
            },
            methods : {
                update(floor_uuid){
                    addLoader();
                    this.floor_uuid = floor_uuid;
                    var url = {{ url('dashboard') }} + '/doctor-to-floor/' + this.floor_uuid + '/update';

                    axios.get(url)
                        .then((response) => {
                            removeLoarder();

                            if(response.data.message.msg_status == 1){
                                addAlert('success', response.data.message.text);
                            }else{
                                addAlert('danger', response.data.message.text);
                            }
                        })
                        .catch((data) => {
                            removeLoarder();
                        });
                },
            }
        });
    </script>
@endsection