@component('mail::message')
# Registration Confirmation

Hello {{ $randomName }},

Thank you for registering. Your password is: {{ $randomPassword }}

Regards,<br>
{{ config('app.name') }}
@endcomponent
