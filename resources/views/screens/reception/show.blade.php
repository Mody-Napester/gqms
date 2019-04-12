<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Tajawal:400,500,700,800,900" rel="stylesheet">

    <style>
        @font-face {
            font-family: GE_SS_Two;
            src: url('/public/assets/fonts/ge-ss-two-medium.ttf') format('ttf');
        }
        body{
            font-family: 'Tajawal', sans-serif;
        }
        .section{
            padding: 1.2rem;
        }
        .section-1{
            padding: 1rem;
        }
        .bg-blue-1{
            background-color: #405566;
        }
        .bg-blue-2{
            background-color: #3D6489;
        }
        .bg-blue-3{
            background-color: #2E5272;
        }
        .bg-gray-1{
            background-color: #A4A5A6;
        }
        .bg-gray-2{
            background-color: #7f8c8d;
        }
        .txt-1{
            font-size: 2rem;
            font-weight: bold;
        }
        .txt-2{
            font-size: 2rem;
            font-weight: bold;
        }
        .txt-3{
            font-size: .5rem;
        }
        .number-app{
            background-color: #FFFFFF;
            padding: 2px;
            color: #2E5272;
            font-size: 2rem;
            font-weight: bold;
            width:100%;
            display: block;
        }
        .text-app{
            color: #FFFFFF;
            font-size: 2rem;
            padding-top: 3px;
            font-weight: bold;
            display: inline-block;
            text-align: right !important;
        }
        .text-app-1{
            color: #FFFFFF;
            font-size: 1.4rem;
            font-weight: bold;
            display: block;
        }
        .text-app-2{
            color: #FFFFFF;
            font-size: 1rem;
            padding-top: 1px;
            display: block;
        }
        .top-div{
            color: #FFFFFF;
            font-size: 2rem;
            font-weight: bold;
            background-color: #7f8c8d;
            padding: 3px 15px;
            display: inline-block;
            border-radius: 5px;
            margin-right: 10px;

        }
        .canceled-res{
            position: relative;
        }
        .canceled-res:after{
            content: 'غير متاح';
            text-align: center;
            color: #FFFFFF;
            font-weight: bold;
            font-size: 2rem;
            padding-top: 20px;
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background-color: #666;
        }

        .logo-image{
            width:50px;
            display: inline-block;
        }

        .bounce-class {
            animation: bounceKeyFrame 7s;
        }

        {{--<?php $counter = 1; ?>--}}
            {{--@for($i=5; $i <= 95; $i+5)--}}
             {{--{{$i}}% {--}}
            {{--background-color: {{ ($counter%2 == 0)? '#36d64c' : '#FFFFFF'}};--}}
            {{--transform: scale(2);--}}
        {{--}--}}
        {{--<?php $counter ++; ?>--}}
            {{--@endfor--}}

        @keyframes bounceKeyFrame {
            0% {
                transform: scale(1);
                background-color: #36d64c;
                /*color: #2E5272;*/
            }
            10% {
                background-color: #36d64c;
                transform: scale(2);
            }
            20% {
                background-color: #FFFFFF;
                transform: scale(2);
            }
            30% {
                background-color: #36d64c;
                transform: scale(2);
            }
            40% {
                background-color: #FFFFFF;
                transform: scale(2);
            }
            50% {
                background-color: #36d64c;
                transform: scale(2);
            }
            60% {
                background-color: #36d64c;
                transform: scale(2);
            }
            70% {
                background-color: #FFFFFF;
                transform: scale(2);
            }
            80% {
                background-color: #36d64c;
                transform: scale(2);
            }
            90% {
                background-color: #FFFFFF;
                transform: scale(2);
            }
            100% {
                /*transform: scale(1);*/
                background-color: #FFFFFF;
                transform: scale(1);
                /*color: #36d64c;*/
            }
        }
    </style>



    <title>{{ $screen->name_en }}</title>
</head>
<body onload="startTime()">

<div>
    <div class="section bg-blue-1 mb-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 text-left">
                    <div class="top-div">{{ $screen->floor->name_en }}</div>
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
    <div class="container-fluid">
        <div class="row">
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

            <div class="col-md-6 pr-0">
                <div class="bg-blue-2 section mb-2">
                    <div class="text-white txt-1 text-center">
                        إنتظار الإستقبال
                    </div>
                </div>

                <!-- Start Reservation Row -->
                <div class="res-row row m-0">
                    <div class="col-md-6 p-0">
                        <div class="bg-gray-1 section mb-2">
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
                        <div class="bg-blue-3 section mb-2">
                            <div class="txt-3 text-center">
                                <div class="row">
                                    <div class="col-md-6">
                                        <span class="number-app">3</span>
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

                <!-- Start Reservation Row -->
                <div class="res-row row m-0">
                    <div class="col-md-6 p-0">
                        <div class="bg-gray-1 section mb-2 canceled-res">
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
                        <div class="bg-blue-3 section mb-2">
                            <div class="txt-3 text-center">
                                <div class="row">
                                    <div class="col-md-6">
                                        <span class="number-app">3</span>
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

                <!-- Start Reservation Row -->
                <div class="res-row row m-0">
                    <div class="col-md-6 p-0">
                        <div class="bg-gray-1 section mb-2">
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
                        <div class="bg-blue-3 section mb-2">
                            <div class="txt-3 text-center">
                                <div class="row">
                                    <div class="col-md-6">
                                        <span class="number-app">3</span>
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

                <!-- Start Reservation Row -->
                <div class="res-row row m-0">
                    <div class="col-md-6 p-0">
                        <div class="bg-gray-1 section mb-2">
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
                        <div class="bg-blue-3 section mb-2">
                            <div class="txt-3 text-center">
                                <div class="row">
                                    <div class="col-md-6">
                                        <span class="number-app">3</span>
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
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

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


    /**
     * Get the user IP throught the webkitRTCPeerConnection
     * @param onNewIP {Function} listener function to expose the IP locally
     * @return undefined
     */
    // function getUserIP(onNewIP) { //  onNewIp - your listener function for new IPs
    //     //compatibility for firefox and chrome
    //     var myPeerConnection = window.RTCPeerConnection || window.mozRTCPeerConnection || window.webkitRTCPeerConnection;
    //     var pc = new myPeerConnection({
    //             iceServers: []
    //         }),
    //         noop = function() {},
    //         localIPs = {},
    //         ipRegex = /([0-9]{1,3}(\.[0-9]{1,3}){3}|[a-f0-9]{1,4}(:[a-f0-9]{1,4}){7})/g,
    //         key;
    //
    //     function iterateIP(ip) {
    //         if (!localIPs[ip]) onNewIP(ip);
    //         localIPs[ip] = true;
    //     }
    //
    //     //create a bogus data channel
    //     pc.createDataChannel("");
    //
    //     // create offer and set local description
    //     pc.createOffer().then(function(sdp) {
    //         sdp.sdp.split('\n').forEach(function(line) {
    //             if (line.indexOf('candidate') < 0) return;
    //             line.match(ipRegex).forEach(iterateIP);
    //         });
    //
    //         pc.setLocalDescription(sdp, noop, noop);
    //     }).catch(function(reason) {
    //         // An error occurred, so handle the failure to connect
    //     });
    //
    //     //listen for candidate events
    //     pc.onicecandidate = function(ice) {
    //         if (!ice || !ice.candidate || !ice.candidate.candidate || !ice.candidate.candidate.match(ipRegex)) return;
    //         ice.candidate.candidate.match(ipRegex).forEach(iterateIP);
    //     };
    // }
    //
    // // Usage
    //
    // getUserIP(function(ip){
    //     console.log(ip);
    // });


    function saveIpInSession() {
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
</body>
</html>