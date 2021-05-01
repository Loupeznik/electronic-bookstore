@props(['dismissable', 'status', 'message'])

<div class="relative flex flex-col sm:flex-row sm:items-center bg-white shadow rounded-md py-5 pl-6 pr-8 sm:pr-6 mb-3"
    x-data="{ show: true }" x-show="show">
    <div class="flex flex-row items-center border-b sm:border-b-0 w-full sm:w-auto pb-4 sm:pb-0">
        @if (Str::lower($status) == 'success')
            <i class="ri-check-double-line text-green-500 mr-2"></i>
        @elseif (Str::lower($status) == 'warning')
            <i class="ri-error-warning-line text-yellow-500 mr-2"></i>
        @elseif (Str::lower($status) == 'error')
            <i class="ri-forbid-2-line text-red-500 mr-2"></i>
        @endif
        <div class="text-sm font-medium ml-3">{{ __(Str::ucfirst($status)) }}</div>
    </div>
    <div class="text-sm tracking-wide text-gray-500 mt-4 sm:mt-0 sm:ml-4">{{ __($message) }}</div>
    @if ($dismissable == true)
        <div
            class="absolute sm:relative sm:top-auto sm:right-auto ml-auto right-4 top-4 text-gray-400 hover:text-gray-800 cursor-pointer">
            <button type="button" @click="show = false">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>
    @endif
</div>
