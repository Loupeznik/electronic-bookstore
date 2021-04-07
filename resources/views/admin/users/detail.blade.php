<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-section-header>
                {{ __('User details') }}
            </x-section-header>
            <div class="mx-auto bg-white rounded-xl shadow-md overflow-hidden">
                <div class="md:flex">
                    <div class="p-4 text-center w-full">
                        <h1 class="font-semibold text-xl">{{ $user->email }}</h1>
                        <div class="border-t mt-2">
                            <dl>
                                <x-book-detail-field :name="'Username'" :value="$user->name" />
                                <x-book-detail-field :name="'Registered'" :value="date('d.m.Y h:i', strtotime($user->created_at))" />
                                <x-book-detail-field :name="'Role'" :value="$user->parseRole()" />
                                @if ($user->hasCustomer())
                                    <x-book-detail-field :name="'Has customer profile'" :value="'YES'" />
                                @else
                                    <x-book-detail-field :name="'Has customer profile'" :value="'NO'" />
                                @endif
                            </dl>
                        </div>
                        @if ($user->hasCustomer())
                        <a href="/admin/customers/{{$user->customer->id}}"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            {{ __('Show customer info for this user') }}
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
