@extends('_layouts.screen')

@section('title') {{ $screen->name_en }} @endsection

@section('content')

    <div class="kiosk-screen">
        <div class="kiosk-screen-in">
            @foreach($screen->floors as $floor)
                <div class="mb-4">
                    <div class="qn-{{$floor->uuid}} return-screen-qn">-</div>
                    <button @click.prevent="printQueue('{{$floor->uuid}}')" class="btn-print">
                        <span style="background-color: rgba(64, 85, 102, .7);padding: 0 10px">{{ $floor->name_en }}</span>
                        <span> اضغط هنا لطباعة حجز</span>
                    </button>
                </div>
            @endforeach
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $('.kiosk-screen').height($(window).height() - 93);

        const app = new Vue({
            el : '#app',
            data : {
            },
            methods : {
                printQueue(floor_uuid){
                    addLoader();
                    var url = '{{ url('/') }}/queues/{{$screen->uuid}}/' + floor_uuid;
                    axios.post(url, {
                        _token : '{{ csrf_token() }}'
                    })
                    .then((response) => {
                        console.log(response);
                        $('.qn-' + floor_uuid).text(response.data.queue_number);
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
    </script>
@endsection