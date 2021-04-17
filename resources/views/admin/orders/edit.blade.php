<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-section-header>
                        {{ __('Update order') }}
                    </x-section-header>
                    <form method="POST" action="/admin/orders/{{ $order->id }}">
                        @csrf
                        @method('PUT')
                        <x-input-oneline-wrapper>
                            <x-label for="order_id" :value="__('Order ID')" />
                            <x-input id="order_id" type="text" value="{{ $order->id }}" disabled />
                        </x-input-oneline-wrapper>
                        <x-input-oneline-wrapper>
                            <x-label for="assignee_id" :value="__('Assigned to')" />
                            <x-input-select id="assignee_id" name="assignee_id" class="w-full" required>
                                <option value="null">-</option>
                                @forelse ($admins as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @empty
                                    <option value="-">No admins found</option>
                                @endforelse
                            </x-input-select>
                        </x-input-oneline-wrapper>
                        <x-input-oneline-wrapper>
                            <x-label for="status" :value="__('Status')" />
                            <x-input-select id="status" name="status" class="w-full" required>
                                <option value="0">{{ __('Accepted') }}</option>
                                <option value="1">{{ __('In progress') }}</option>
                                <option value="2">{{ __('Completed') }}</option>
                                <option value="3">{{ __('Cancelled') }}</option>
                                <option value="4">{{ __('Problem') }}</option>
                            </x-input-select>
                        </x-input-oneline-wrapper>
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
