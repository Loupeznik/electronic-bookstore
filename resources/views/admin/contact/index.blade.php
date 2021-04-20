<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contact forms') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-section-header>
                {{ __('Pending contact forms') }}
            </x-section-header>

            @if (session('status'))
                <x-dismissable-alert>
                    {{ session('status') }}
                </x-dismissable-alert>
            @endif

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-table :columns="['ID', 'Assigned to', 'Name', 'Email',  'Created AT', 'Actions']">
                    @forelse ($forms as $form)
                        <x-table-row
                            :row="[$form->id, $form->assignee->name ?? '-', $form->name, $form->email, date('d.m.Y h:i', strtotime($form->created_at))]"
                            :actions="['show', 'delete']" :id="$form->id" />
                    @empty
                        <x-table-row :row="['-','-','-','-','-','-']" />
                    @endforelse
                </x-table>
            </div>
        </div>
    </div>
</x-app-layout>
