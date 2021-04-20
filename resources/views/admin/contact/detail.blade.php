<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contact forms') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-section-header>
                {{ __('Contact form details') }}
            </x-section-header>
            <div class="mx-auto bg-white rounded-xl shadow-md overflow-hidden">
                <div class="md:flex">
                    <div class="p-4 text-center w-full">
                        <h1 class="font-semibold text-xl">{{ $contact->id }}</h1>
                        <div class="border-t mt-2">
                            <dl>
                                <x-book-detail-field :name="'Name'" :value="$contact->name" />
                                <x-book-detail-field :name="'Email'" :value="$contact->email" />
                                <x-book-detail-field :name="'Assigned to'" :value="$contact->assignee->name ?? '-'" />
                                <x-book-detail-field :name="'Created at'" :value="date('d.m.Y h:i', strtotime($contact->created_at))" />
                                <x-book-detail-field :name="'Status'" :value="$contact->status == 0 ? 'Pending' : 'Complete'" />
                                <x-book-detail-field :name="'Message'" :value="$contact->content" />        
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
