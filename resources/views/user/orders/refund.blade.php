<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User dashboard') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <x-section-header>
            {{ __('Create a refund') }}
        </x-section-header>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="/user/orders/{{ $order->id }}/refund">
                        @csrf
                        <div class="flex flex-wrap mb-6">
                            <div class="relative w-full">
                                <div class="mt-4 w-full">
                                    <x-label for="desc" :value="__('Describe the reason for this refund request')" />
                                    <x-input-textarea
                                    id="desc" name="description" class="w-full" required>{{ old('description') }}</x-input-textarea>
                                </div>
                            </div>
                        </div>
                        <x-button>{{ __('Create') }}</x-button>
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

    <x-order-detail :order="$order" />

</x-app-layout>
