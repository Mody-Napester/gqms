@extends('_layouts.screen')

@section('title') {{ $screen->name_en }} @endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <!-- Doctor Queue -->
            <div class="col-md-6 pl-0">
                <div class="bg-blue-2 section mb-2">
                    <div class="text-white txt-1 text-center">
                        إنتظار العيادات
                    </div>
                </div>


                <!-- Start Reservation Row -->
                <div class="res-row row m-0">
                    <div class="col-md-6 p-0">
                        <div class="bg-gray-2 section mb-2">
                            <div class="txt-3 text-center">
                                <div class="row">
                                    <div class="col-md-6">
                                        <span class="number-app">152</span>
                                    </div>
                                    <div class="col-md-6">
                                        <span class="text-app">حجز</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 p-0">
                        <div class="bg-blue-3 section-1 mb-2">
                            <div class="txt-3 text-right">
                                <div class="row">
                                    <div class="col-md-12">
                                        <span class="text-app-1">د/أحمد سامى</span>
                                        <span class="text-app-2">عيادة القلب</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Reservation Row -->

                <!-- Start Reservation Row -->
                <div class="res-row row m-0">
                    <div class="col-md-6 p-0">
                        <div class="bg-gray-2 section mb-2">
                            <div class="txt-3 text-center">
                                <div class="row">
                                    <div class="col-md-6">
                                        <span class="number-app">152</span>
                                    </div>
                                    <div class="col-md-6">
                                        <span class="text-app">حجز</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 p-0">
                        <div class="bg-blue-3 section-1 mb-2">
                            <div class="txt-3 text-right">
                                <div class="row">
                                    <div class="col-md-12">
                                        <span class="text-app-1">د/أحمد سامى</span>
                                        <span class="text-app-2">عيادة القلب</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Reservation Row -->

                <!-- Start Reservation Row -->
                <div class="res-row row m-0">
                    <div class="col-md-6 p-0">
                        <div class="bg-gray-2 section mb-2">
                            <div class="txt-3 text-center">
                                <div class="row">
                                    <div class="col-md-6">
                                        <span class="number-app bounce-class">152</span>
                                    </div>
                                    <div class="col-md-6">
                                        <span class="text-app">حجز</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 p-0">
                        <div class="bg-blue-3 section-1 mb-2">
                            <div class="txt-3 text-right">
                                <div class="row">
                                    <div class="col-md-12">
                                        <span class="text-app-1">د/أحمد سامى</span>
                                        <span class="text-app-2">عيادة القلب</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Reservation Row -->

                <!-- Start Reservation Row -->
                <div class="res-row row m-0">
                    <div class="col-md-6 p-0">
                        <div class="bg-gray-2 section mb-2">
                            <div class="txt-3 text-center">
                                <div class="row">
                                    <div class="col-md-6">
                                        <span class="number-app">152</span>
                                    </div>
                                    <div class="col-md-6">
                                        <span class="text-app">حجز</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 p-0">
                        <div class="bg-blue-3 section-1 mb-2">
                            <div class="txt-3 text-right">
                                <div class="row">
                                    <div class="col-md-12">
                                        <span class="text-app-1">د/أحمد سامى</span>
                                        <span class="text-app-2">عيادة القلب</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Reservation Row -->

            </div>

            <!-- Desk Queue -->
            <div class="col-md-6 pr-0">
                <div class="bg-blue-2 section mb-2">
                    <div class="text-white txt-1 text-center">
                        إنتظار الإستقبال
                    </div>
                </div>

                @foreach($desks as $desk)
                <!-- Start Reservation Row -->
                <div class="res-row row m-0">
                    <div class="col-md-6 p-0">
                        <div id="{{ $desk->uuid }}" class="bg-gray-1 section mb-2 @if(!in_array($desk->id , $logegdInUsers)) canceled-res @endif">
                            <div class="txt-3 text-center">
                                <div class="row">
                                    <div class="col-md-6">
                                        <span class="number-app">{{ ($queue = \App\DeskQueue::getCurrentDeskQueues($desk->id))? $queue->queue_number : '-'  }}</span>
                                    </div>
                                    <div class="col-md-6">
                                        <span class="text-app">حجز</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 p-0">
                        <div class="bg-blue-3 section mb-2">
                            <div class="txt-3 text-center">
                                <div class="row">
                                    <div class="col-md-6">
                                        <span class="number-app">{{ $desk->name_en }}</span>
                                    </div>
                                    <div class="col-md-6">
                                        <span class="text-app">شباك</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Reservation Row -->
                @endforeach
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        const app = new Vue({
            el : '#app',
            data : {
                desk_uuid : '',
                active_desk : false,
            },
            methods : {
                listen(){
                    Echo.channel('desk-queue-screen')
                        .listen('NextDeskQueue', (response) => {
                            var targetEl = $('#' + response.desk + ' .number-app');

                            targetEl.text(response.queue);

                            targetEl.addClass( "bounce-class" ).one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function(){
                                targetEl.removeClass( "bounce-class" );
                            });

                            console.log(response);
                        });

                    Echo.channel('desk-queue-screen')
                        .listen('DeskStatus', (response) => {
                            if(response.available == 1){
                                $('#' + response.desk).removeClass('canceled-res');
                            }else{
                                $('#' + response.desk).addClass('canceled-res');
                            }
                        });
                }
            },
            mounted() {
                this.listen();
            }
        });
    </script>
@endsection