<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-section-header>
                        {{ __('Edit customer') }}
                    </x-section-header>
                    <form method="POST" action="/admin/customers/{{$customer->id}}">
                        @csrf
                        @method('PUT')
                        <div class="-mx-3 md:flex mb-6">
                            <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                                <x-label for="name" :value="__('Name')" />
                                <x-input id="name" name="name" type="text" value="{{ $customer->name }}" required />
                            </div>
                            <div class="md:w-1/2 px-3">
                                <x-label for="surname" :value="__('Surname')" />
                                <x-input id="surname" name="surname" type="text" value="{{ $customer->surname }}" required />
                            </div>
                        </div>
                        <div class="-mx-3 md:flex mb-6">
                            <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                                <x-label for="street" :value="__('Street')" />
                                <x-input id="street" name="street" type="text" value="{{ $customer->street }}" required />
                            </div>
                            <div class="md:w-1/2 px-3">
                                <x-label for="nr" :value="__('Street number')" />
                                <x-input id="nr" name="street_nr" type="number" value="{{ $customer->street_nr }}" required />
                            </div>
                        </div>
                        <div class="-mx-3 md:flex mb-6">
                            <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                                <x-label for="city" :value="__('City')" />
                                <x-input id="city" name="city" type="text" value="{{ $customer->city }}" required />
                            </div>
                            <div class="md:w-1/2 px-3">
                                <x-label for="zip" :value="__('ZIP')" />
                                <x-input id="zip" name="zip" type="number" value="{{ $customer->zip }}" required />
                            </div>
                        </div>
                        <div class="-mx-3 md:flex mb-6">
                            <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                                <x-label for="state" :value="__('Country')" />
                                <x-input-select id="state" name="country" class="w-full" required>
                                    <option value="cz">{{ __('Czech Republic') }}</option>
                                    <option value="sk">{{ __('Slovakia') }}</option>
                                </x-input-select>
                            </div>
                            <div class="md:w-1/2 px-3">
                                <x-label for="phone" :value="__('Phone number')" />
                                <x-input id="phone" name="phone" type="tel" pattern="[0-9]{3}[0-9]{3}[0-9]{3}" value="{{ $customer->phone }}" />
                            </div>
                        </div>
                        <x-button>
                            {{ __('Update') }}
                        </x-button>
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
