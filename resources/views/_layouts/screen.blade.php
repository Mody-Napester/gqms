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

    <title>@yield('title')</title>

    {{--<link href="https://fonts.googleapis.com/css?family=Tajawal:400,500,700,800,900" rel="stylesheet">--}}

    <link href="{{ url('assets/css/arabic-font.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/loader.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/custom.css') }}" rel="stylesheet" type="text/css" />

    <style>
        body{
            font-family: 'Tajawal', sans-serif;
        }
    </style>

    @yield('head')

</head>
<body onload="startTime()">

    <div id="app">
        <div class="section bg-blue-1">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <div class="top-div">{{ $screen->floor->name_en }}</div>
                        <div class="top-div">{{ $screen->name_en }}</div>
                        <div class="top-div">
                            <div id="time-txt" style="width: 150px;text-align: center;"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-white txt-2 text-right">
                            <span>مستشفى الجنزورى التخصصى</span>
                            <img class="logo-image" src="{{ url('assets/images/ganz-logo.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        @yield('content')
    </div>

    <script src="{{ url('assets/js/jquery.min.js') }}"></script>
    <script src="{{ url('assets/js/popper.min.js') }}"></script>
    <script src="{{ url('assets/js/bootstrap.min.js') }}"></script>

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
            // NOTE: window.RTCPeerConnection is "not a constructor" in FF22/23
            var RTCPeerConnection = /*window.RTCPeerConnection ||*/ window.webkitRTCPeerConnection || window.mozRTCPeerConnection;

            if (RTCPeerConnection) (function () {
                var rtc = new RTCPeerConnection({iceServers: []});
                if (1 || window.mozRTCPeerConnection) {      // FF [and now Chrome!] needs a channel/stream to proceed
                    rtc.createDataChannel('', {reliable: false});
                }

                rtc.onicecandidate = function (evt) {
                    // convert the candidate to SDP so we can run it through our general parser
                    // see https://twitter.com/lancestout/status/525796175425720320 for details
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
                    {{--$.ajax({--}}
                    {{--url: '{{route('saveIpInSession')}}',--}}
                    {{--method: 'POST',--}}
                    {{--data: {--}}
                    {{--client_ip: displayAddrs[0]--}}
                    {{--},--}}
                    {{--headers: {token: '{{csrf_token()}}'},--}}
                    {{--success: function (data) {--}}

                    {{--}--}}
                    {{--});--}}

                    console.log(displayAddrs[0]);
                    // document.getElementById('list').textContent = displayAddrs.join(" or perhaps ") || "n/a";
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
            /*else {
                       document.getElementById('list').innerHTML = "<code>ifconfig | grep inet | grep -v inet6 | cut -d\" \" -f2 | tail -n1</code>";
                       document.getElementById('list').nextSibling.textContent = "In Chrome and Firefox your IP should display automatically, by the power of WebRTCskull.";
                   }*/

        }

        saveIpInSession();
    </script>

    <script src="{{ url('assets/js/loader.js') }}"></script>

    @yield('scripts')

    </body>
</html>