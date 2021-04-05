<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Authors') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <x-section-header>
            {{ __('Add new author') }}
        </x-section-header>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{route('authors.store')}}">
                        @csrf
                        <div class="flex flex-wrap mb-6">
                            <div class="relative w-full">
                                <div class="mt-4 w-full">
                                    <x-label for="name" :value="__('Name')" />
                                    <x-input
                                    id="name" name="name" class="w-full" type="text" value="{{old('name')}}" required />
                                </div>
                                <div class="mt-4 w-full">
                                    <x-label for="surname" :value="__('Surname')" />
                                    <x-input
                                    id="surname" name="surname" class="w-full" type="text" value="{{old('surname')}}" required />
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-wrap mb-6">
                            <div class="relative w-full">
                                <div class="mt-4 w-full">
                                    <x-label for="nationality" :value="__('Country')" />
                                    <x-input
                                    id="nationality" name="nationality" class="w-full" type="text" value="{{old('nationality')}}" />
                                </div>
                                <div class="mt-4 w-full">
                                    <x-label for="birthdate" :value="__('Birthdate')" />
                                    <x-input
                                    id="birthdate" name="birthdate" class="w-full" type="date" value="{{old('birthdate')}}" />
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
</x-app-layout>
