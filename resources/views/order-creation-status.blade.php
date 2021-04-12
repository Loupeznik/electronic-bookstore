@extends('welcome')
@section('content')
    <div class="shadow-lg rounded-2xl p-4 bg-white w-64 mx-auto my-4">
        <div class="w-full h-full text-center">
            <div class="flex h-full flex-col justify-between">
                <i class="ri-check-double-line text-xl text-green-600"></i>
                <p class="text-gray-800 text-md py-2 px-6">
                    {{ __('Order') }} {{session('order')->id}} {{ __('has been created') }}
                </p>
                <div class="flex items-center justify-between gap-4 w-full mt-8">
                    <x-front-action-button :link="'/'"><i class="ri-arrow-go-back-line mr-2"></i> {{ __('Back to homepage') }}</x-front-action-button>
                </div>
            </div>
        </div>
    </div>
@endsection
