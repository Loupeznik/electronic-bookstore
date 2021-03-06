<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Payment methods') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-section-header>
                        {{ __('Edit payment method') }}
                    </x-section-header>
                    <form method="POST" action="/user/methods/{{$method->id}}">
                        @csrf
                        @method('PUT')
                        <div class="flex flex-wrap mb-6">
                            <div class="relative w-full">
                                <div class="mt-4 w-full">
                                    <x-label for="type" :value="__('Type')" />
                                    <x-input-select id="type" name="type" class="w-full" required>
                                        <option @if ($method->type == 'PayPal') default @endif>PayPal</option>
                                        <option @if ($method->type == 'VISA') default @endif>VISA</option>
                                        <option @if ($method->type == 'Mastercard') default @endif>Mastercard</option>
                                        <option @if ($method->type == 'bank') default @endif value="bank">{{ __('Wire transfer') }}</option>
                                    </x-input-select>
                                </div>
                            </div>
                        </div>
                        <x-button>{{ __('Update') }}</x-button>
                    </form>

                    @if ($errors->any())
                        <div class="rounded-lg p-2 mt-2 bg-yellow-100">
                            <x-input-error class="mb-4" :errors="$errors" />
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
