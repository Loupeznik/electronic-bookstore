<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">

            <x-section-header>
                {{ __('Table of users') }}
            </x-section-header>

            @if (session('status'))
                <x-alert :dismissable="true" :status="session('status')" :message="session('message')" />
            @endif

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-table :columns="['Name', 'Email', 'Registration date', 'Role', 'Actions']">
                    @forelse ($users as $user)
                        <x-table-row
                            :row="[$user->name, $user->email, date('d.m.Y h:i', strtotime($user->created_at)), $user->parseRole()]"
                            :actions="['show']" :id="$user->id" />
                    @empty
                        <x-table-row :row="['-','-','-']" />
                    @endforelse
                </x-table>
            </div>
            <div class="mt-3 w-1/2 mx-auto">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
