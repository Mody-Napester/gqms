@extends('_layouts.dashboard')

@section('title') {{ $desk->name_en }} @endsection

@section('content')

    <div class="row">
        <div class="col-lg-8">
            <div class="card-box table-responsive">
                <h4 class="m-t-0 header-title">All Floors</h4>

            </div>
        </div>

        <div class="col-lg-4">
            <div class="card-box table-responsive">
                <h4 class="m-t-0 header-title">Served Today (5)</h4>

                <table class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Queue</th>
                            <th>Action</th>
                            <th>Date</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>
    <!-- end row -->

@endsection