@component('mail::message')
# Introduction

Name: {{$contact->full_name}}

From: {{$contact->email}}

The body of your message@auth

{{$contact->message}}
{{-- @endauth
 --}}
@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
