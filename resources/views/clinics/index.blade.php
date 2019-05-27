@extends('_layouts.dashboard')

@section('title') Clinics @endsection

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="btn-group pull-right m-t-15">
                <a @click.prevent="syncClient('clinics')" class="btn btn-danger waves-effect waves-light">Sync <i class="fa fa-fw fa-refresh"></i></a>
            </div>

            <h4 class="page-title">Clinics</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{ config('app.name') }}</a></li>
                <li class="breadcrumb-item"><a href="#">Clinics</a></li>
                <li class="breadcrumb-item active">Index</li>
            </ol>
        </div>
    </div>

    <div class="row" id="goToAll">
        <div class="col-lg-12">
            <div class="card-box table-responsive">
                <h4 class="m-t-0 header-title">All Clinics</h4>
                <p class="text-muted font-14 m-b-30">
                    Here you will find all the resources to make actions on them.
                </p>

                <div class="get-synced-data">
                    @include('clinics._list')
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
            }
        });
    </script>
@endsection