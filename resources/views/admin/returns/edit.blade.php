<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Refund requests') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-section-header>
                        {{ __('Edit refund request') }}
                    </x-section-header>
                    <form method="POST" action="/admin/refunds/{{$refund->id}}">
                        @csrf
                        @method('PUT')
                        <x-input-oneline-wrapper>
                            <x-label for="order_id" :value="__('Order ID')" />
                            <x-input id="order_id" name="order_id" type="text" value="{{ $refund->order->id }}" required />
                        </x-input-oneline-wrapper>
                        <x-input-oneline-wrapper>
                            <x-label for="assignee_id" :value="__('Assigned To')" />
                            <x-input-select id="assignee_id" name="assignee_id" class="w-full" required>
                                <option value="null">-</option>
                                @forelse ($admins as $user)
                                    <option value="{{ $user->id }}" @if ($refund->assignee_id != null) @if($user->id == $refund->assignee->id) selected @endif @endif>{{ $user->name }}</option>
                                @empty
                                    <option value="-">No admins found</option>
                                @endforelse
                            </x-input-select>
                        </x-input-oneline-wrapper>
                        <x-input-oneline-wrapper>
                            <x-label for="status" :value="__('Status')" />
                            <x-input-select id="status" name="status" class="w-full">
                                <option value="0" @if ($refund->status == 0) selected @endif>Received</option>
                                <option value="1" @if ($refund->status == 1) selected @endif>Under review</option>
                                <option value="2" @if ($refund->status == 2) selected @endif>Finished</option>
                            </x-input-select>
                        </x-input-oneline-wrapper>
                        <x-input-oneline-wrapper>
                            <x-label for="result" :value="__('Result')" />
                            <x-input-select id="result" name="result" class="w-full">
                                <option value="null">-</option>
                                <option value="0" @if ($refund->result == 0) selected @endif>Order refunded</option>
                                <option value="1" @if ($refund->result == 1) selected @endif>Exchanged goods</option>
                                <option value="2" @if ($refund->result == 2) selected @endif>Refund not accepted</option>
                            </x-input-select>
                        </x-input-oneline-wrapper>
                        <x-input-oneline-wrapper>
                            <x-label for="description" :value="__('Description')" />
                            <x-input-textarea id="description" name="description" class="w-full" required>{{ $refund->description }}</x-input-textarea>
                        </x-input-oneline-wrapper>
                        <x-input-oneline-wrapper>
                            <x-label for="completed_at" :value="__('Completed at')" />
                            <x-input type="date" name="completed_at" id="completed_at" class="w-full" />
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
