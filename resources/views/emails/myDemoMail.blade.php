@component('mail::message')
# {{ $mailData['title'] }}
  
You are receiving this email because we received a OT approve request.
  
@component('mail::button', ['url' => $mailData['url']])
Visit Our System
@endcomponent
  
Thanks,

{{ config('app.name') }}
@endcomponent
