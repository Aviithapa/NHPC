@extends('web.layouts.app')
@section('content')
<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">

        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __(" Thank you for signing up! Before getting started. Please, could you verify your email address by entering the code send to your email address, we just emailed to you? We will gladly send you another if you didn't receive the email or have any query please contact to
            Mr Satyanand : 9803283319.") }}

        </div>
        <div class="mb-4 text-sm text-gray-600">
            {{ __("साइन अप गर्नुभएकोमा धन्यवाद! सुरु गर्नु अघि।
कृपया, हामीले भर्खरै तपाईलाई इमेल गरेका थियौं, तपाईको इमेल ठेगानामा पठाइएको कोड प्रविष्ट गरेर तपाईले आफ्नो इमेल ठेगाना प्रमाणित गर्न सक्नुहुन्छ?
 यदि तपाईले इमेल प्राप्त गर्नुभएन भने हामी खुशीसाथ तपाईलाई अर्को पठाउनेछौं") }}
        </div>

        <form method="POST" action="{{ route('verify.user.code') }}">
        @csrf

        <!-- Email Address -->
            <div>
                <x-label for="Verification Code" :value="__('Verification Code')" />

                <x-input id="verification_code" class="block mt-1 w-full" type="text" name="verification_code" :value="old('verification_code')" required autofocus />
            </div>


            <x-button class="ml-3">
                {{ __('Verify') }}
            </x-button>
        </form>
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
