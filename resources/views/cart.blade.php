@extends('welcome')
@section('content')
    <div class="px-4 py-6 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-8">
        <div class="max-w-screen-sm sm:text-center sm:mx-auto">
            <div class="flex flex-col max-w-3xl p-6 space-y-4 sm:p-10">
                <h2 class="text-2xl uppercase font-semibold">{{ __('Your Cart') }}</h2>
                <ul class="flex flex-col divide-y divide-gray-700">
                    <livewire:cart />
                </ul>
            </div>
        </div>
    </div>
@endsection
