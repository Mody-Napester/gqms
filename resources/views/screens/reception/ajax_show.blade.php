<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="author" content="Ahmed Samy">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ url('assets/images/logo_sm.png') }}">

    <title>{{ $screen->name_en }}</title>

    {{--<link href="https://fonts.googleapis.com/css?family=Tajawal:400,500,700,800,900" rel="stylesheet">--}}

    <link href="{{ url('assets/css/arabic-font.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/ajax-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/ajax-bootstrap-theme.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/loader.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/custom_screen_ajax.css') }}" rel="stylesheet" type="text/css" />

    <style>
        body{
            font-family: 'Tajawal', sans-serif;
        }
    </style>

</head>
<body onload="startTime()">

<div id="app">
    <div class="bg-blue-1">
        <div class="section-2">
            <table class="table" style="border: 0;margin: 0;">
                <tr>
                    <td style="padding: 10px;">
                        <div class="top-div">{{ $screen->floor->name_en }}</div>
                        <div class="top-div">{{ $screen->name_en }}</div>
                        <div class="top-div">
                            <div id="time-txt" style="width: 150px;text-align: center;"></div>
                        </div>
                    </td>
                    <td>
                        <div class="text-white txt-2 text-right">
                            <span>مستشفى الجنزورى التخصصى</span>
                            <img class="logo-image" src="{{ url('assets/images/ganz-logo.jpg') }}" alt="">
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <table class="table">
        <tr>
            <td style="width: 50%;text-align: center;">
                <div class="bg-green-2 section ">
                    <div class="text-white txt-1 text-center">
                        إنتظار العيادات
                    </div>
                </div>
            </td>
            <td style="width: 50%;text-align: center;">
                <div class="bg-blue-2 section ">
                    <div class="text-white txt-1 text-center">
                        إنتظار الإستقبال
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td style="padding: 0;margin: 0;width: 50%;">
                <!-- Doctor Queue -->
                <table class="table">
                    @foreach($screen->rooms as $room)
                        <tr>
                            <td class="res-row">
                                <div id="{{ $room->uuid }}" class="bg-gray-2 section  @if(!in_array($room->id , $logegdInRoomUsers)) canceled-res @endif">
                                    <div class="txt-3 text-center">
                                        <table class="table">
                                            <tr>
                                                <td class="text-center">
                                                    <span class="number-app">{{ ($queue = \App\RoomQueue::getCurrentRoomQueues($room->id))? $queue->queue_number : '-'  }}</span>
                                                </td>
                                                <td class="text-right">
                                                    <span class="text-app">حجز</span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="bg-green-3 section-1">
                                    <div class="txt-3">
                                        <table class="table">
                                            <tr>
                                                <td class="col-md-4 text-center">
                                                    <span class="number-app">{{ $room->name_en }}</span>
                                                </td>
                                                <td class="col-md-8 text-right">
                                                    <span id="doctor-{{ $room->uuid }}" class="text-app-1">{{ ($room->user)? $room->user->doctor->name_ar : '-' }}</span>
                                                    <span id="clinic-{{ $room->uuid }}" class="text-app-2">{{ ($room->user)? $room->user->doctor->clinic->name_ar : '-' }}</span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </td>

            <td style="padding: 0;margin: 0;width: 50%;">
                <!-- Desk Queue -->
                <table class="table">
                    @foreach($desks as $desk)
                        <tr>
                            <td class="res-row">
                                <div id="{{ $desk->uuid }}" class="bg-gray-1 section  @if(!in_array($desk->id , $logegdInDeskUsers)) canceled-res @endif">
                                    <div class="txt-3 text-center">
                                        <table class="table">
                                            <tr>
                                                <td class="text-center">
                                                    <span class="number-app">{{ ($queue = \App\DeskQueue::getCurrentDeskQueues($desk->id))? $queue->queue_number : '-'  }}</span>
                                                </td>
                                                <td class="text-right">
                                                    <span class="text-app">حجز</span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="bg-blue-3 section">
                                    <div class="txt-3 text-center">
                                        <table class="table">
                                            <tr>
                                                <td class="text-center">
                                                    <span class="number-app">{{ $desk->name_en }}</span>
                                                </td>
                                                <td class="text-right">
                                                    <span class="text-app">شباك</span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </td>
        </tr>
    </table>

    <audio id="call_sound" preload="none" src="{{ url('assets/sounds/call_1.wav') }}"></audio>
</div>

<script src="{{ url('assets/js/jquery.min.js') }}"></script>
<script src="{{ url('js/app.js') }}"></script>

@include('_scripts.screen')

<script>
    function PlaySound(soundObj) {
        var audio = new Audio(soundObj);
        audio.play();
    }

    // function blink(key) {
    //     var f = $('#' + key + ' .number-app');
    //     setTimeout(function() {
    //         f.style.display = (f.style.display == 'none' ? '' : 'none');
    //         f.style.background = (f.style.display == '#2BBBAD' ? '' : '#ffffff');
    //     }, 500);
    // }
    //
    // var notLocked = true;
    // $.fn.animateHighlight = function(highlightColor, duration) {
    //     var originalBg = this.css("backgroundColor");
    //     if (notLocked) {
    //         notLocked = false;
    //         this.stop().css("background-color", highlightColor)
    //             .animate({backgroundColor: originalBg}, duration);
    //         setTimeout( function() { notLocked = true; }, duration);
    //     }
    // };

    var time = 3000;

    setInterval(function () {
        // Send ajax request
        var url = '{{ route('screens.getScreensAjaxContents', $screen->uuid) }}';
        $.ajax({
            method:'GET',
            url:url,
            beforeSend:function () {
                console.log('Sending .. ');
            },
            success:function (data) {
                $.each(data.deskQueues, function(key,valueObj){
                    // alert(key + "/" + valueObj.toSource() );

                    var targetEl = $('#' + key + ' .number-app');

                    var targetNumber = targetEl.text();

                    if(valueObj.queueNumber != targetNumber && valueObj.queueNumber != 0){
                        console.log(valueObj.queueNumber);

                        targetEl.text(valueObj.queueNumber);

                        var i = setInterval(
                            function () {
                                targetEl.css('background', 'lightgreen');
                                setTimeout(function () {
                                    targetEl.css('background', '#ffffff');
                                }, 200)
                            }, 500);

                        setTimeout(function( ) { targetEl.css('background', '#ffffff'); clearInterval( i ); }, 10000);

                        PlaySound('{{ url('assets/sounds/call_1.wav') }}');
                    }else{
                        if(valueObj.reminder == 1){
                            var i = setInterval(
                                function () {
                                    targetEl.css('background', 'lightgreen');
                                    setTimeout(function () {
                                        targetEl.css('background', '#ffffff');
                                    }, 200)
                                }, 500);

                            setTimeout(function( ) { targetEl.css('background', '#ffffff'); clearInterval( i ); }, 10000);

                            PlaySound('{{ url('assets/sounds/call_1.wav') }}');
                        }
                    }

                    if(valueObj.status == 1){
                        $('#' + key).removeClass('canceled-res');
                    }
                    else{
                        $('#' + key).addClass('canceled-res');
                    }

                });

                $.each(data.roomQueues, function(key,valueObj){
                    // alert(key + "/" + valueObj.toSource() );

                    var targetEl = $('#' + key + ' .number-app');

                    var targetNumber = targetEl.text();

                    if(valueObj.queueNumber != targetNumber && valueObj.queueNumber != 0){
                        console.log(valueObj.queueNumber);

                        var i = setInterval(
                            function () {
                                targetEl.css('background', 'lightgreen');
                                setTimeout(function () {
                                    targetEl.css('background', '#ffffff');
                                }, 200)
                            }, 500);

                        setTimeout(function( ) { targetEl.css('background', '#ffffff'); clearInterval( i ); }, 10000);

                        PlaySound('{{ url('assets/sounds/call_1.wav') }}');
                        // document.getElementById('call_sound').play();
                    }

                    if(valueObj.status == 1){
                        $('#' + key).removeClass('canceled-res');
                    }
                    else{
                        $('#' + key).addClass('canceled-res');
                    }

                });
            },
            error:function () {
                console.log('error');
            }
        });

    }, time);
</script>

</body>
</html>