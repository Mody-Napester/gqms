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
    {{--<audio id="call_tts_url" autoplay src="http://translate.google.com/translate_tts?tl=en&q=amr%20ahmedyuyui&client=tw-ob"></audio>--}}

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
                    Echo.channel('desk-queue-screen-{{ $screen->area->uuid }}')
                        .listen('NextDeskQueue', (response) => {
                            var targetEl = $('#' + response.desk + ' .number-app');

                            targetEl.text(response.queue);

                            targetEl.addClass( "bounce-class" ).one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function(){
                                targetEl.removeClass( "bounce-class" );
                            });

                            {{--PlaySound('{{ url('assets/sounds/call_1.wav') }}');--}}
                            document.getElementById('call_sound').play();

                            // $('#call_tts_url').attr('src', 'https://translate.google.com/translate_tts?tl=en&q=agent%20number%20'+ response.desk_name +'%20-%20desk%20number%20'+ response.queue +'&client=tw-ob');
                            // $('#call_tts_url').attr('src', response.ttsULR);

                            // var audio = document.getElementById('call_tts_url');
                            //
                            // // Show loading animation.
                            // // var playPromise = audio.play();
                            //
                            // if (playPromise !== undefined) {
                            //     playPromise.then(_ => {
                            //         // Automatic playback started!
                            //         // Show playing UI.
                            //         console.log('S');
                            //     })
                            //     .catch(error => {
                            //         // Auto-play was prevented
                            //         // Show paused UI.
                            //         console.log('E');
                            //     });
                            // }

                            console.log(response);
                        });

                    // Flash Room Queue
                    Echo.channel('room-queue-screen-{{ $screen->area->uuid }}')
                    // Echo.channel('room-queue-screen')
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
                                $('#row-' + response.desk).removeClass('canceled-res-container');
                                $('#' + response.desk).removeClass('canceled-res');
                            }else{
                                $('#row-' + response.desk).addClass('canceled-res-container');
                                $('#' + response.desk).addClass('canceled-res');
                            }
                        });

                    Echo.channel('room-queue-screen')
                        .listen('RoomStatus', (response) => {
                            console.log(response);
                            $('#doctor-' + response.room).text(response.doctor);
                            $('#clinic-' + response.room).text(response.clinic);
                            if(response.available == 1){
                                $('#row-div' + response.room).removeClass('canceled-res-div-container');
                                $('#row-' + response.room).removeClass('canceled-res-container');
                                $('#' + response.room).removeClass('canceled-res');
                            }else{
                                $('#row-div' + response.room).addClass('canceled-res-div-container');
                                $('#row-' + response.room).addClass('canceled-res-container');
                                $('#' + response.room).addClass('canceled-res');
                            }
                        });

                    // Reload Screen
                    Echo.channel('reload-screen-{{ $screen->uuid }}')
                        .listen('ReloadScreen', (response) => {
                            location.reload();
                        });
                }
            },
            mounted() {
                this.listen();
            }
        });
    </script>
@endsection