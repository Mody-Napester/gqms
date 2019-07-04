@extends('_layouts.screen')

@section('title') {{ $screen->name_en }} @endsection

@section('head')
    <link href="{{ url('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>

    <style>
        .select2-container .select2-selection--single {
            height: 80px;
            font-size: 30px;
            font-weight: bold;
            color: #035B88;
        }

        .select2-container .select2-selection--single .select2-selection__rendered {
            font-weight: bold;
            padding: 20px 0;
            color: #035B88;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 80px;
            color: #035B88;
        }
    </style>
@endsection

@section('content')

    <div class="alpha-container text-center pt-2 pb-2 mb-2 spe-alph" style="direction: rtl !important;background-color: #eeeeee">
        @foreach($arabic_alphas as $letter)
            <div style="border-radius: 3px; min-width: 40px;font-size: 30px;
            font-weight: bold;padding: 3px 3px;display: inline-block;
            background-color: #dc3545;color: #ffffff;cursor: pointer" @click.prevent="searchByLetter('speciality', '{{ $letter }}')">{{ $letter }}</div>
        @endforeach
    </div>

    <div class="alpha-container text-center pt-2 pb-2 mb-2 doc-alph" style="display: none;direction: rtl !important;background-color: #eeeeee">
        @foreach($arabic_alphas as $letter)
            <div style="border-radius: 3px; min-width: 40px;font-size: 30px;
            font-weight: bold;padding: 3px 3px;display: inline-block;
            background-color: #0a6aa1;color: #ffffff;cursor: pointer" @click.prevent="searchByLetter('doctor', '{{ $letter }}')">{{ $letter }}</div>
        @endforeach
    </div>

    <div class="container-fluid b-container">
        <div class="row" style="height: 100%;">
            <div class="col-md-5 text-center">
                <div class="kiosk-screen" style="background-color: #dddddd;">
                    <div class="kiosk-screen-in">
                        @foreach($screen->floors as $floor)
                            @foreach($floor->areas as $area)
                                <div class="mb-4 floors-item" id="{{ $floor->uuid }}">
                                    <div class="qn-{{$area->uuid}} return-screen-qn">-</div>
                                    <button @click.prevent="printQueue('{{$area->uuid}}')" class="btn-print">
                                        <span style="background-color: rgba(64, 85, 102, .7);padding: 0 10px;direction: ltr;text-align: left">{{ $area->name_en }}-{{ $floor->name_en }}</span>
                                        <span> طباعة حجز</span>
                                    </button>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-7 pl-0" style="height: 100%;overflow: auto;">
                <div class="doctors-floors" style="background-color: #dddddd;font-weight: bold;text-transform: capitalize;font-size: 20px">
                    @include('screens.kiosk._doctor_floors')
                </div>
            </div>
        </div>
    </div>

    {{--<div class="kiosk-screen">--}}
    {{--<div class="kiosk-screen-in">--}}
    {{--<div class="mb-4">--}}
    {{--<select class="select2" style="width: 100%;" id="select2">--}}
    {{--<option selected disabled value="">ابحث عن الدكتور</option>--}}
    {{--@foreach($doctors as $doctor)--}}
    {{--<option value="{{ $doctor->uuid }}">د / {{ $doctor->name_ar }}</option>--}}
    {{--@endforeach--}}
    {{--<option v-for="doctor in doctors" :value="doctor.uuid">@{{ doctor.name_ar }}</option>--}}
    {{--</select>--}}
    {{--</div>--}}
    {{--@foreach($screen->floors as $floor)--}}
    {{--<div class="mb-4 floors-item" id="{{ $floor->uuid }}">--}}
    {{--<div class="qn-{{$floor->uuid}} return-screen-qn">-</div>--}}
    {{--<button @click.prevent="printQueue('{{$floor->uuid}}')" class="btn-print">--}}
    {{--<span style="background-color: rgba(64, 85, 102, .7);padding: 0 10px">{{ $floor->name_en }}</span>--}}
    {{--<span> اضغط هنا لطباعة حجز</span>--}}
    {{--</button>--}}
    {{--</div>--}}
    {{--@endforeach--}}
    {{--</div>--}}
    {{--</div>--}}

@endsection

@section('scripts')

    <script>
        // $('.kiosk-screen').height($(window).height() - 93);

        const app = new Vue({
            el: '#app',
            data: {

            },
            methods: {
                searchByLetter(type, letter) {
                    addLoader();
                    var url = '{{ url('screens/search-by-letter') }}/' + type + '/' + letter;
                    axios.get(url)
                        .then((response) => {
                            // console.log(letter);
                            console.log(response);
                            $('.doctors-floors').html(response.data.view);
                            removeLoarder();
                        })
                        .catch((response) => {
                            removeLoarder();
                        });
                },
                printQueue(area_uuid) {
                    addLoader();
                    var url = '{{ url('/') }}/queues/{{$screen->uuid}}/' + area_uuid;
                    axios.post(url, {
                        _token: '{{ csrf_token() }}'
                    })
                        .then((response) => {
                            console.log(response);
                            $('.qn-' + area_uuid).text(response.data.queue_number);
                            removeLoarder();
                        })
                        .catch((response) => {
                            console.log(0, response.data);
                            removeLoarder();
                        });

                    $('.floors-item').show();
                    // $('#select2').val('').select2();
                },
                getFloors(doctor) {
                    addLoader();
                    var url = '{{ url('doctors/get/floors') }}/' + doctor;

                    axios.get(url)
                        .then((response) => {
                            console.log(response);
                            $('.floors-item').hide();
                            $('#' + response.data.floor).show();
                            removeLoarder();
                        })
                        .catch((response) => {
                            console.log(0, response.data);
                            removeLoarder();
                        });
                }
            },
            mounted() {
            }
        });

        $('#select2').on('change', function () {
            var select2Val = $(this).val();
            app.getFloors(select2Val);
        });
    </script>

    <script>
        function bHeight() {
            var windowHeight = $(window).height();
            var sectionHeight = $('.section').height();
            var alphaContainerHeight = $('.alpha-container').height();
            // var bContainerHeight = windowHeight - (sectionHeight + alphaContainerHeight);
            var bContainerHeight = windowHeight - (180);

            return bContainerHeight;
        }

        $(window).on('load', function () {
            $('.b-container').height(bHeight());
        });

        // $(window).on('resize', function () {
        //     $('.b-container').height(bHeight());
        // });

        $('body').on('click', '.top-btns-toggle',function () {
            if ($('.top-btns').css('top') == '0px'){
                $('.top-btns').animate({
                    top:'-60px'
                },100);
            } else{
                $('.top-btns').animate({
                    top:'0'
                },100);
            }

            console.log($('.top-btns').css('top'));
        });

        $('body').on('click', '.top-btns-speciality',function () {
            $('.spe-alph').show();
            $('.doc-alph').hide();

            app.searchByLetter('speciality', 'الكل');

            $('.top-btns-toggle').trigger('click');
        });
        $('body').on('click', '.top-btns-doctor',function () {
            $('.spe-alph').hide();
            $('.doc-alph').show();

            app.searchByLetter('doctor', 'الكل');

            $('.top-btns-toggle').trigger('click');
        });
    </script>
@endsection