<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <title>Voice Test</title>
</head>
<body>

    <div class="container">
{{--        <audio id="audiotag" src="{{ url('assets/sounds/call_1.wav') }}" preload="auto"></audio>--}}

        <audio class="audio" src="" hidden></audio>
    </div>

    {{--<script src="{{ url('assets/js/responsivevoice.js') }}"></script>--}}
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>

    <script>
        // function voiceEnd() {
        //     responsiveVoice.speak("رَقَمْ 20", "Arabic Female", {rate: 1, pitch: 1, volume: 1});
        // }
        //
        // audioElement = document.getElementById('audiotag');
        // audioElement.play();
        // audioElement.addEventListener('ended', function (ev) {
        //     responsiveVoice.speak("رَقَمْ  15", "Arabic Female", {
        //         rate: 1,
        //         pitch: 1,
        //         volume: 1,
        //         // onstart: voiceStart,
        //         onend: voiceEnd
        //     });
        // });

        // responsiveVoice.speak("رَقَمْ  15", "Arabic Female", {
        //     rate: 1,
        //     pitch: 1,
        //     volume: 1
        //     // onstart: voiceStart,
        //     // onend: voiceEnd
        // });

        // var text = "رَقَمْ 15";
        // var text = "15";
        // text = encodeURIComponent(text)
        // var urlAPI = "https://translate.google.com/translate_tts?tl=ar&q=" + text + "&client=tw-ob";
        // $('#audiotag').attr('src', urlAPI).get(0).play();


        $(document).ready(function(){
            var language = 'ar';
            var text = "vsdfds";
            text = encodeURIComponent(text)

            var urlAPI = "https://translate.google.com/translate_tts?ie=UTF-8&tl=" + language + "&q=" + text + "&client=tw-ob";
            $('.audio').attr('src', urlAPI).get(0).play();
        });
    </script>
</body>
</html>