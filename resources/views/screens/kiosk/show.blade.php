@extends('_layouts.screen')

@section('title') {{ $screen->name_en }} @endsection

@section('content')

    <div class="container-fluid kiosk-screen">
        <div class="row">
            <div class="col-md-12 text-center">
                <button @click.prevent="printQueue()" class="btn-print">اضغط هنا لطباعة دور</button>
                {{--<div class="return-screen-qn">@{{ queue }}</div>--}}
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        const app = new Vue({
            el : '#app',
            data : {
                queue : ''
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
                        // this.queue = response;
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