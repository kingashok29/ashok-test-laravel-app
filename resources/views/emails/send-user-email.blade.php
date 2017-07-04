@component('mail::message')
# Hello {{ $user->name }},

You received this important email from {{ config('app.name') }}.

@component('mail::panel')
{{ $message }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
