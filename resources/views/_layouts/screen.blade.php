{{--@if($screen->slug == 's4-6')--}}
        {{--<!DOCTYPE html>--}}
{{--<html>--}}
{{--<head>--}}
    {{--<title>Text To Speech</title>--}}

    {{--<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">--}}
{{--</head>--}}
{{--<body>--}}

{{--<div class="container">--}}
    {{--<div class="row">--}}
        {{--<div class="col-md-3"></div>--}}
        {{--<div class="col-md-6 mt-5">--}}
            {{--<div class="form-group">--}}
                {{--<label>Select language</label>--}}
                {{--<select name="language" class="form-control language">--}}
                    {{--<option value="en">English</option>--}}
                    {{--<option value="ar">Arabic</option>--}}
                {{--</select>--}}
            {{--</div>--}}
            {{--<div class="form-group">--}}
                {{--<textarea name="text" class="form-control text"></textarea>--}}
            {{--</div>--}}
            {{--<button class="say btn btn-sm btn-primary">Say it</button>--}}

            {{--<audio class="audio" src="" hidden></audio>--}}
        {{--</div>--}}
        {{--<div class="col-md-3"></div>--}}
    {{--</div>--}}
{{--</div>--}}

{{--<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>--}}

{{--<script type="text/javascript">--}}
    {{--$(document).ready(function(){--}}
        {{--$('button.say').on('click', function(){--}}
            {{--var language = $('.language').val();--}}
            {{--// var text = $('.text').val();--}}
            {{--// var text = 'عميل رقم 15 - غرفة 110';--}}
            {{--// text = encodeURIComponent(text)--}}

            {{--// var urlAPI = "https://translate.google.com/translate_tts?tl=" + language + "&q=" + text + "&client=tw-ob";--}}
            {{--var urlAPI = "https://translate.google.com/translate_tts?tl=ar&q=عميل رقم 15 - غرفة 110&client=tw-ob";--}}
            {{--$('.audio').attr('src', urlAPI).get(0).play();--}}
        {{--});--}}

        {{--setInterval(function () {--}}
            {{--$('button.say').trigger('click');--}}
        {{--}, 5000)--}}
    {{--});--}}
{{--</script>--}}
{{--</body>--}}
{{--</html>--}}
{{--@else--}}

{{--@endif--}}


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="author" content="Ahmed Samy">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ url('assets/images/logo_sm.png') }}">

    <title>@yield('title')</title>

    {{--<link href="https://fonts.googleapis.com/css?family=Tajawal:400,500,700,800,900" rel="stylesheet">--}}

    <link href="{{ url('assets/css/arabic-font.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/loader.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/custom.css') }}" rel="stylesheet" type="text/css" />

    <style>
        body{
            font-family: 'Tajawal', sans-serif;
        }
        .top-btns{
            position: absolute;
            z-index: 9999;
            left: 50%;
            transform: translateX(-50%);
            color: #ffffff;
            padding-top: 10px;
            text-align: center;
            top: -60px;
        }
        .top-btns .top-btns-doctor, .top-btns .top-btns-speciality{
            cursor: pointer;
            border-radius: 3px;
            display: inline-block;
            padding: 10px;
            font-size: 18px;
            width: 150px;

        }
        .top-btns-toggle{
            cursor: pointer;
            border-radius: 3px;
            display: inline-block;
            background-color: rgba(0,0,0,.5);
            padding: 10px;
            font-size: 18px;
            text-align: center;
            margin-top: 10px;
        }
        .top-btns-doctor{background-color: #0a6aa1;margin-right: 5px;}
        .top-btns-speciality{background-color: #dc3545;}

    </style>

    @yield('head')

</head>
<body>

    <div>
        @if($screen->screen_type_id == config('vars.screen_types.kiosk'))
            <div class="top-btns">
                <div class="top-btns-doctor"><i class="fa fa-heart fa-fw"></i> الاطباء</div>
                <div class="top-btns-speciality"><i class="fa fa-hospital-o fa-fw"></i> التخصصات</div>
                <br>
                <div class="top-btns-toggle">
                    <i class="fa fa-arrow-down fa-fw"></i>
                </div>
            </div>
        @endif

        <div class="section bg-blue-1">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <div class="top-div">{{ $screen->area->name_en }}</div>
                        <div class="top-div">{{ $screen->name_en }}</div>
                        {{--<div class="top-div">--}}
                            {{--<div id="time-txt" style="width: 150px;text-align: center;"></div>--}}
                        {{--</div>--}}
                        <div class="top-div">
                            <div id="jqclock" style="width: 200px;text-align: center;" class="jqclock" data-time="<?php echo time(); ?>"></div>
{{--                            <div style="width: 170px;text-align: center;">{{ time() }}</div>--}}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-white txt-2 text-right">
                            <span>مستشفى الجنزورى التخصصى</span>
                            @if($screen->screen_type_id == config('vars.screen_types.kiosk'))
                                <span style="font-size: 26px;background-color: rgba(0,0,0,.2);padding: 6px;margin-right: 10px;cursor: pointer;text-align: center;border-radius: 5px;" onclick="location.reload();">
                                    <i class="fa fa-refresh fa-fw"></i>
                                </span>
                            @endif
                            <img class="logo-image" src="{{ url('assets/images/ganz-logo.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="app">
            @yield('content')
        </div>
    </div>

    <script type="text/javascript">
        // Get JS Time
        // function startTime()
        // {
        //     var today= new Date();
        //     var h=today.getHours();
        //     var m=today.getMinutes();
        //     var s=today.getSeconds();
        //
        //     // add a zero in front of numbers<10
        //     m=checkTime(m);
        //     s=checkTime(s);
        //     document.getElementById('time-txt').innerHTML=h+":"+m+":"+s;
        //     t=setTimeout('startTime()',500);
        // }
        //
        // function checkTime(i)
        // {
        //     if (i<10) { i="0" + i;}
        //     return i;
        // }
        //
        // startTime();

        // Get Ip
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

    <script src="{{ url('assets/js/jquery.min.js') }}"></script>
    <script src="{{ url('assets/js/jqClock.js') }}"></script>
    <script src="{{ url('assets/js/popper.min.js') }}"></script>
    <script src="{{ url('assets/js/bootstrap.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            customtimestamp = parseInt($("#jqclock").data("time"));
            $("#jqclock").clock({"timestamp": '{{ time()+7200 }}', "calendar": false});
        });
    </script>

    <script src="{{ url('js/app.js') }}"></script>

    <script src="{{ url('assets/js/loader.js') }}"></script>

    @yield('scripts')

    </body>
</html>