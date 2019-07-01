@extends('_layouts.screen')

@section('title') {{ $screen->name_en }} @endsection

@section('content')

    <div class="container-fluid mt-2">
        <div class="row">
            <!-- Doctor Queue -->
            @include('screens.reception._room_queue')

            <!-- Desk Queue -->
            @include('screens.reception._desk_queue')
        </div>
    </div>

    <audio id="call_sound" preload="none" src="{{ url('assets/sounds/call_1.wav') }}"></audio>

    {{--<embed src="{{ url('assets/sounds/call_1.wav') }}" autostart="false" width="0" height="0" id="sound1" enablejavascript="true">--}}

@endsection

@section('scripts')
    <script>
        // function PlaySound(soundObj) {
        //     var audio = new Audio(soundObj);
        //     audio.play();
        // }

        const app = new Vue({
            el : '#app',
            data : {
                desk_uuid : '',
                active_desk : false,
            },
            methods : {
                listen(){
                    // Flash Desk Queue
                    Echo.channel('desk-queue-screen')
                        .listen('NextDeskQueue', (response) => {
                            var targetEl = $('#' + response.desk + ' .number-app');

                            targetEl.text(response.queue);

                            targetEl.addClass( "bounce-class" ).one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function(){
                                targetEl.removeClass( "bounce-class" );
                            });

                            {{--PlaySound('{{ url('assets/sounds/call_1.wav') }}');--}}
                            document.getElementById('call_sound').play();

                            console.log(response);
                        });

                    // Flash Room Queue
                    Echo.channel('room-queue-screen')
                        .listen('NextRoomQueue', (response) => {
                            var targetEl = $('#' + response.room + ' .number-app');

                            targetEl.text(response.queue);

                            targetEl.addClass( "bounce-class" ).one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function(){
                                targetEl.removeClass( "bounce-class" );
                            });

                            {{--PlaySound('{{ url('assets/sounds/call_1.wav') }}');--}}
                            document.getElementById('call_sound').play();

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

                    Echo.channel('room-queue-screen')
                        .listen('RoomStatus', (response) => {
                            console.log(response);
                            $('#doctor-' + response.room).text(response.doctor);
                            $('#clinic-' + response.room).text(response.clinic);
                            if(response.available == 1){
                                $('#' + response.room).removeClass('canceled-res');
                            }else{
                                $('#' + response.room).addClass('canceled-res');
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