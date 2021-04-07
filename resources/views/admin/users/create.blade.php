<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <x-section-header>
            {{ __('Add new user') }}
        </x-section-header>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf
                        <input type="checkbox" name="terms" style="display: none" checked>
                        <div class="flex flex-wrap mb-6">
                            <div class="relative w-full">
                                <div class="mt-4 w-full">
                                    <x-label for="username" :value="__('Username')" />
                                    <x-input id="username" name="name" class="w-full" type="text"
                                        value="{{ old('name') }}" required />
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-wrap mb-6">
                            <div class="relative w-full">
                                <div class="mt-4 w-full">
                                    <x-label for="email" :value="__('Email')" />
                                    <x-input id="email" name="email" class="w-full" type="email"
                                        value="{{ old('email') }}" required />
                                </div>
                            </div>
                        </div>
                        <div class="-mx-3 md:flex mb-6">
                            <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                                <x-label for="password" :value="__('Password')" />
                                <x-input id="password" name="password" class="w-full" type="password" required />
                            </div>
                            <div class="md:w-1/2 px-3">
                                <x-label for="password_confirmation" :value="__('Confirm password')" />
                                <x-input id="password_confirmation" name="password_confirmation" class="w-full" type="password" required />
                            </div>
                        </div>
                        <div class="flex flex-wrap mb-6">
                            <div class="relative w-full">
                                <div class="mt-4 w-full">
                                    <x-label for="role" :value="__('Role')" />
                                    <x-input-select id="role" name="role" class="w-full" required>
                                        <option value="0">{{ __('User') }}</option>
                                        <option value="1">{{ __('Editor') }}</option>
                                        <option value="2">{{ __('Admin') }}</option>
                                    </x-input-select>
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
