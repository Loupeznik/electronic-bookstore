@extends('welcome')
@section('content')

<section class="p-6">
	<form class="container mx-auto w-full max-w-xl p-8 space-y-6 rounded-md shadow" method="POST" action="{{ route('contact.store') }}">
        @csrf
		<h2 class="w-full text-3xl font-bold leading-tight">{{ __('Contact us') }}</h2>
		<div>
			<label for="name" class="block mb-0.5 ml-0.5">{{ __('Name') }}</label>
			<input id="name" name="name" type="text" placeholder="{{ __('Your name') }}" class="block w-full p-2 rounded" value="{{ old('name') }}" required>
		</div>
		<div>
			<label for="email" class="block mb-0.5 ml-0.5">Email</label>
			<input id="email" name="email" type="email" placeholder="{{ __('Your email') }}" class="block w-full p-2 rounded" value="{{ old('email') }}" required>
		</div>
		<div>
			<label for="content" class="block mb-0.5 ml-0.5">{{ __('Message') }} </label>
			<textarea id="content" name="content" type="text" placeholder="{{ __('Your message') }}" class="block w-full p-2 rounded autoexpand" required>{{ old('content') }}</textarea>
		</div>
		<div>
			<button type="submit" class="w-full px-4 py-2 font-bold rounded shadow bg-blue-300">{{ __('Send') }}</button>
		</div>
        @if ($errors->any())
            <div class="rounded p-2 mt-2 bg-red-300">
                <x-input-error class="mb-4" :errors="$errors" />
            </div>
        @endif
        @if (session('status'))
        <div class="rounded p-2 mt-2 bg-green-300">
            {{ __(session('message')) }}
        </div>
        @endif
	</form>
</section>

@endsection
