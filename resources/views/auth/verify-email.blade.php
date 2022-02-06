@extends('web.layouts.app')
@section('content')
<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">

        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __("Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? We will gladly send you another if you didn't receive the email.") }}

        </div>
        <div class="mb-4 text-sm text-gray-600">
            {{ __("साइन अप गर्नुभएकोमा धन्यवाद! सुरु गर्नु अघि, हामीले भर्खरै तपाईलाई इमेल गरेको लिङ्कमा क्लिक गरेर तपाईले आफ्नो इमेल ठेगाना प्रमाणित गर्न सक्नुहुन्छ? यदि तपाईले इमेल प्राप्त गर्नुभएन भने हामी खुशीसाथ तपाईलाई अर्को पठाउनेछौं।") }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
        </div>
    </x-auth-card>
</x-guest-layout>
@endsection
