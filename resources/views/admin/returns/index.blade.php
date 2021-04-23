<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Refund requests') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-section-header>
                {{ __('Table of refund requests') }}
            </x-section-header>

            @if (session('status'))
                <x-alert :dismissable="true" :status="session('status')" :message="session('message')" />
            @endif

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-table :columns="['ID', 'Order ID', 'Status', 'Assigned to', 'Created at', 'Actions']">
                    @forelse ($returns as $refund)
                        <x-table-row
                            :row="[$refund->id, $refund->order->id, $refund->status(), $refund->assignee->name ?? '-', date('d.m.Y h:i', strtotime($refund->created_at))]"
                            :actions="['edit', 'show']" :id="$refund->id" />
                    @empty
                        <x-table-row :row="['-','-','-','-','-','-']" />
                    @endforelse
                </x-table>
            </div>
            {{ $returns->links() }}
        </div>
    </div>
</x-app-layout>
