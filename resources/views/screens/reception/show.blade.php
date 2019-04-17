@extends('_layouts.screen')

@section('title') {{ $screen->name_en }} @endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <!-- Doctor Queue -->
            @include('screens.reception._doctor_queue')

            <!-- Desk Queue -->
            @include('screens.reception._desk_queue')

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