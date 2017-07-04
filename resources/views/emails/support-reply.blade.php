@component('mail::message')
# You received a reply from CloudBinaryInvest

Reply to your support ticket --

@component('mail::panel')
{{ $reply_body }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
