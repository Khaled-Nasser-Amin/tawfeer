@component('mail::message')
# Recovering Your Password

please click the button below to reset your password.

@component('mail::button', ['url' => $url])
submit
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
