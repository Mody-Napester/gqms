@extends('_layouts.dashboard')

@section('title') Doctors @endsection

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="btn-group pull-right m-t-15">
                <a @click.prevent="syncClient('doctors')" class="btn btn-danger waves-effect waves-light">Sync <i class="fa fa-fw fa-refresh"></i></a>
            </div>

            <h4 class="page-title">Doctors</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{ config('app.name') }}</a></li>
                <li class="breadcrumb-item"><a href="#">Doctors</a></li>
                <li class="breadcrumb-item active">Index</li>
            </ol>
        </div>
    </div>

    <div class="row" id="goToAll">
        <div class="col-lg-12">
            <div class="card-box table-responsive">
                <h4 class="m-t-0 header-title">All Doctors</h4>
                <p class="text-muted font-14 m-b-30">
                    Here you will find all the resources to make actions on them.
                </p>

                <div class="get-synced-data">
                    @include('doctors._list')
                </div>
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
                nickname : '',
                doctor_uuid : '',
            },
            methods : {
                syncClient(what){
                    addLoader();

                    var url = '{{ url('integration/sync') }}/' + what;

                    axios.get(url)
                        .then((response) => {
                            if(response.data.message.msg_status == 1){
                                $('.get-synced-data').html(response.data.view);
                                // Default Datatable
                                $('#datatable').DataTable();
                                addAlert('success', response.data.message.text);
                            }else{
                                addAlert('danger', response.data.message.text);
                            }

                            removeLoarder();
                        })
                        .catch((data) => {
                            addAlert('danger', 'Error!!');
                            removeLoarder();
                        });

                },

                updateDoctor(uuid){
                    addLoader();

                    this.doctor_uuid = uuid;
                    this.nickname = $('#'+uuid).val();

                    var url = '{{ url('dashboard/doctors') }}/' + this.doctor_uuid + '/' + this.nickname + '/update-nickName';

                    axios.get(url)
                        .then((response) => {
                            if(response.data.message.msg_status == 1){
                                addAlert('success', response.data.message.text);
                            }else{
                                addAlert('danger', response.data.message.text);
                            }
                            removeLoarder();
                        })
                        .catch((data) => {
                            addAlert('danger', 'Error!!');
                            removeLoarder();
                        });
                },
            }
        });

    </script>
@endsection