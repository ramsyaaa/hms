@foreach (session('flash_notification', collect())->toArray() as $message)
    @if ($message['overlay'])
        @include('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => $message['title'],
            'body'       => $message['message']
        ])
    @else
        <div class="alert alert-{{ $message['level'] }} {{ $message['important'] ? 'alert-important' : '' }} custom-message">
            <div class="d-flex text-white align-items-center">
                <i class="fa-solid fa-face-smile me-4"></i>
                <div>
                    <span class="text-white">{{ $message['message'] }}</span>
                </div>
            </div>
        </div>
        {{--        <div class="alert--}}
        {{--                    alert-{{ $message['level'] }}--}}
        {{--                    {{ $message['important'] ? 'alert-important' : '' }}"--}}
        {{--                    role="alert"--}}
        {{--        >--}}
        {{--            @if ($message['important'])--}}
        {{--                <button type="button"--}}
        {{--                        class="close"--}}
        {{--                        data-dismiss="alert"--}}
        {{--                        aria-hidden="true"--}}
        {{--                >&times;</button>--}}
        {{--            @endif--}}

        {{--            {{ $message['message'] }}--}}
        {{--        </div>--}}
    @endif
@endforeach

{{ session()->forget('flash_notification') }}
