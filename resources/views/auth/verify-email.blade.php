@extends('web.layouts.app')
@section('content')
<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">

        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __(" Thank you for signing up, before starting. Please, verify your email by entering the code sent in your email address. If any confusion, please contact to NHPC at Office hours") }} <a href='https://www.facebook.com/profile.php?id=100091224663594' style="color:red">Go to this link</a>

        </div>
        <div class="mb-4 text-sm text-gray-600">
            {{ __("परिषदको नाम दर्ता प्रक्रिया साईन अप गर्नु भएकोमा स्वागत छ । कृपया आफ्नो ईमेल ठेगानामा परिषदबाट पठाईएको कोड राखी आफ्नो ईमेल प्रमाणित गर्नुहोस ।यदि कुनै समस्या छ भने कार्यालय समयमा परिषद मा सम्पर्क गर्नुहोला ।") }}
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
