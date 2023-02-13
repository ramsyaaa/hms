@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <img src="{{ asset(getLogoUrl()) }}" class="logo" alt="{{ getAppName() }}">
        @endcomponent
    @endslot


    {{-- Body --}}
    <div>
        <h2>Hello ,</h2>
        <p>You are receiving this email because we received a password reset request for your account.</p>
        <br>
        <div style="display: flex;justify-content: center">
            <a href="{{ $link }}"
               style="padding: 10px 15px;text-decoration: none;font-size: 14px;background-color: dodgerblue ;font-weight: 500;border: none;color: white">
                Reset Password
            </a>
        </div>
        <br>
        <p>This password reset link will expire in 60 minutes.</p>
        <p>If you did not request a password reset, no further action is required.</p>
        <p>
            Regards,
            <br>
            {{ config('app.name') }}
        </p>
        <h6>
            If you’re having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser:
            <a href="{{ $link }}">{{ $link }}</a>
        </h6>
    </div>


    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            <p>© {{ date('Y') }} {{ getAppName() }}. All rights reserved</p>
        @endcomponent
    @endslot
@endcomponent
`




