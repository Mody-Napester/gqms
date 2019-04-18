@extends('_layouts.screen')

@section('title') {{ $screen->name_en }} @endsection

@section('content')

    <div class="kiosk-screen">
        <div class="kiosk-screen-in">
            @foreach($screen->floors as $floor)
                <div class="mb-4">
                    <div class="return-screen-qn">@{{ queue }}</div>
                    <button @click.prevent="printQueue()" class="btn-print"><span>{{ $floor->name_en }}</span> اضغط هنا لطباعة دور</button>
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
                queue : '-'
            },
            methods : {
                printQueue(){
                    addLoader();
                    var url = '{{ route('desks.queues.storeNewQueue', $screen->uuid) }}';
                    axios.post(url, {
                        _token : '{{ csrf_token() }}'
                    })
                    .then((response) => {
                        console.log(response);
                        this.queue = response.data.queue_number;
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