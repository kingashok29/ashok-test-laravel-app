@component('mail::message')
# Welcome to {{ config('app.name') }},

Thanks for creating an account.

@component('mail::panel')
Hello {{ $user->name }}, Thanks for signing up, click the button below to verify your account.
Once you verify account you will be able to login.
@endcomponent

@component('mail::button', ['url' => $url ])
Verify account
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
