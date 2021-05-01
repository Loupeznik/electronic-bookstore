<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Shipping methods') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-section-header>
                        {{ __('Edit shipping method') }}
                    </x-section-header>
                    <form method="POST" action="/admin/shipping-methods/{{$shipping_method->id}}">
                        @csrf
                        @method('PUT')
                        <div class="flex flex-wrap mb-6">
                            <div class="relative w-full">
                                <div class="mt-4 w-full">
                                    <x-label for="name" :value="__('Name')" />
                                    <x-input
                                    id="name" name="name" class="w-full" type="text" value="{{$shipping_method->name}}" required />
                                </div>
                                <div class="mt-4 w-full">
                                    <x-label for="cost" :value="__('Cost')" />
                                    <x-input
                                    id="cost" name="cost" class="w-full" type="text" value="{{$shipping_method->cost}}" required />
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
