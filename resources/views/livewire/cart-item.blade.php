<div>
    <li class="flex flex-col py-6 sm:flex-row sm:justify-between">
        <div class="flex w-full space-x-2 sm:space-x-4">
            <img class="flex-shrink-0 object-cover w-20 h-20 rounded outline-none sm:w-32 sm:h-32" src="/storage/{{$item->book->photo_path ?? config('filesystems.cover_photo_placeholder_path')}}" alt="book">
            <div class="flex flex-col justify-between w-full pb-4">
                <div class="flex justify-between w-full pb-2 space-x-2">
                    <div class="space-y-1">
                        <h3 class="text-lg font-semibold text-left sm:pr-8">{{ $item->book->name }}</h3>
                        <p class="text-sm text-left"> {{ $item->book->author->name . ' ' . $item->book->author->surname }} </p>
                    </div>
                    <div class="text-right">
                        <p class="text-lg font-semibold"> {{ $item->book->sale_price ?? $item->book->price }} {{ config('app.currency', null) }}</p>
                    </div>
                </div>
                <div class="flex text-sm divide-x">
                    <livewire:add-to-cart :itemId="$item->id" :buttonType="'remove'" />
                </div>
            </div>
        </div>
    </li>
</div>
