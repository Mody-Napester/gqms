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

<script type="text/javascript">
    function startTime()
    {
        var today=new Date();
        var h=today.getHours();
        var m=today.getMinutes();
        var s=today.getSeconds();

        // add a zero in front of numbers<10
        m=checkTime(m);
        s=checkTime(s);
        document.getElementById('time-txt').innerHTML=h+":"+m+":"+s;
        t=setTimeout('startTime()',500);
    }

    function checkTime(i)
    {
        if (i<10)
        {
            i="0" + i;
        }
        return i;
    }

    function saveIpInSession()
    {
        var RTCPeerConnection = /*window.RTCPeerConnection ||*/ window.webkitRTCPeerConnection || window.mozRTCPeerConnection;

        if (RTCPeerConnection) (function () {
            var rtc = new RTCPeerConnection({iceServers: []});
            if (1 || window.mozRTCPeerConnection) {      // FF [and now Chrome!] needs a channel/stream to proceed
                rtc.createDataChannel('', {reliable: false});
            }
            rtc.onicecandidate = function (evt) {
                if (evt.candidate) grepSDP("a=" + evt.candidate.candidate);
            };
            rtc.createOffer(function (offerDesc) {
                grepSDP(offerDesc.sdp);
                rtc.setLocalDescription(offerDesc);
            }, function (e) {
                console.warn("offer failed", e);
            });


            var addrs = Object.create(null);
            addrs["0.0.0.0"] = false;

            function updateDisplay(newAddr) {
                if (newAddr in addrs) return;
                else addrs[newAddr] = true;
                var displayAddrs = Object.keys(addrs).filter(function (k) {
                    return addrs[k];
                });
                console.log(displayAddrs[0]);
            }

            function grepSDP(sdp) {
                var hosts = [];
                sdp.split('\r\n').forEach(function (line) { // c.f. http://tools.ietf.org/html/rfc4566#page-39
                    if (~line.indexOf("a=candidate")) {     // http://tools.ietf.org/html/rfc4566#section-5.13
                        var parts = line.split(' '),        // http://tools.ietf.org/html/rfc5245#section-15.1
                            addr = parts[4],
                            type = parts[7];
                        if (type === 'host') updateDisplay(addr);
                    } else if (~line.indexOf("c=")) {       // http://tools.ietf.org/html/rfc4566#section-5.7
                        var parts = line.split(' '),
                            addr = parts[2];
                        updateDisplay(addr);
                    }
                });
            }
        })();
    }

    saveIpInSession();
</script>

<script>
    // function PlaySound(soundObj) {
    //     var audio = new Audio(soundObj);
    //     audio.play();
    // }

    setTimeout(function () {
        // Send ajax request
        var url = '{{ route('screens.getScreensAjaxContents', $screen->uuid) }}';
        $.ajax({
            method:'GET',
            url:url,
            beforeSend:function () {
                console.log('Sending .. ');
            },
            success:function (data) {

            },
            error:function () {

            }
        });

    }, 10000);

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

                        PlaySound('{{ url('assets/sounds/call_1.wav') }}');
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

                        PlaySound('{{ url('assets/sounds/call_1.wav') }}');
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

</body>
</html>