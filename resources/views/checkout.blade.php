@extends('welcome')
@section('content')
    <div class="px-4 py-6 mx-auto md:px-24 lg:px-8 lg:py-8">
        <div class="sm:text-center sm:mx-auto">
            <div class="p-6 space-y-4 sm:p-10">
                <h2 class="text-2xl uppercase font-semibold">{{ __('Review your order') }}</h2>
                    @if($cart->items->count() < 1)
                        <p>Your cart is empty</p>
                    @else
                    <div class="grid grid-cols-2">
                        <div class="w-full">
                            <h2 class="text-lg uppercase font-semibold mb-3">{{ __('Order items') }}</h2>
                            @foreach($cart->items as $item)
                                    <div class="shadow-md rounded-lg w-1/2 mx-auto py-2 my-8 px-2 text-right">
                                        <div class="grid grid-cols-2 gap-0">
                                            <div>
                                                <img class="flex-shrink-0 object-cover rounded outline-none sm:w-32 sm:h-32" src="/storage/{{$item->book->photo_path ?? config('filesystems.cover_photo_placeholder_path')}}" alt="book">
                                            </div>
                                            <div>
                                                <h3 class="font-semibold">{{ $item->book->name }}</h3>
                                                <p class="text-sm"> {{ $item->book->author->name . ' ' . $item->book->author->surname }} </p>
                                                <p class="text-sm">{{ __('Qty') }}: {{$item->count}}</p>
                                                <p class="text-sm">{{ __('Price') }}: {{$item->book->price * $item->count}} Kč</p>
                                            </div>
                                        </div>
                                    </div>
                            @endforeach
                            <div class="shadow-md rounded-lg w-1/2 mx-auto py-2 my-8 px-2 text-center text-gray-800">
                                <h2 class="font-bold text-xl uppercase">{{ __('Total') }}</h2>
                                <p class="font-semibold text-lg">{{ $cart->overallSum() }} Kč</p>
                            </div>
                            <div class="w-max mx-auto my-3">
                                <x-front-action-button :link="'/cart'">
                                    <i class="ri-arrow-go-back-line mr-2"></i> {{ __('Back to cart') }}
                                </x-front-action-button>
                            </div>
                        </div>
                        <div class="w-full">
                            <h2 class="text-lg uppercase font-semibold mb-3">{{ __('Your details') }}</h2>
                            <form method="POST" action="/checkout">
                                @csrf
                                <div class="-mx-3 md:flex mb-6">
                                    <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                                        <x-label for="name" :value="__('Name')" />
                                        <x-input id="name" name="name" type="text" value="{{ Auth::user()->customer->name ?? old('name') }}" required />
                                    </div>
                                    <div class="md:w-1/2 px-3">
                                        <x-label for="surname" :value="__('Surname')" />
                                        <x-input id="surname" name="surname" type="text" value="{{ Auth::user()->customer->surname ?? old('surname') }}" required />
                                    </div>
                                </div>
                                <div class="-mx-3 md:flex mb-6">
                                    <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                                        <x-label for="street" :value="__('Street')" />
                                        <x-input id="street" name="street" type="text" value="{{ Auth::user()->customer->street ?? old('street') }}" required />
                                    </div>
                                    <div class="md:w-1/2 px-3">
                                        <x-label for="nr" :value="__('Street number')" />
                                        <x-input id="nr" name="street_nr" type="number" value="{{ Auth::user()->customer->street_nr ?? old('street_nr') }}" required />
                                    </div>
                                </div>
                                <div class="-mx-3 md:flex mb-6">
                                    <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                                        <x-label for="city" :value="__('City')" />
                                        <x-input id="city" name="city" type="text" value="{{ Auth::user()->customer->city ?? old('city') }}" required />
                                    </div>
                                    <div class="md:w-1/2 px-3">
                                        <x-label for="zip" :value="__('ZIP')" />
                                        <x-input id="zip" name="zip" type="number" value="{{ Auth::user()->customer->zip ?? old('zip') }}" required />
                                    </div>
                                </div>
                                <div class="-mx-3 md:flex mb-6">
                                    <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                                        <x-label for="state" :value="__('Country')" />
                                        <x-input-select id="state" name="country" class="w-full" required>
                                            <option value="cz" @auth @isset(Auth::user()->customer->country) @if (Auth::user()->customer->country == 'cz') default @endif @endisset @endauth>{{ __('Czech Republic') }}</option>
                                            <option value="sk" @auth @isset(Auth::user()->customer->country) @if (Auth::user()->customer->country == 'sk') default @endif @endisset @endauth>{{ __('Slovakia') }}</option>
                                        </x-input-select>
                                    </div>
                                    <div class="md:w-1/2 px-3">
                                        <x-label for="phone" :value="__('Phone number')" />
                                        <x-input id="phone" name="phone" type="tel" pattern="[0-9]{3}[0-9]{3}[0-9]{3}" value="{{ Auth::user()->customer->phone ?? old('phone') }}" />
                                    </div>
                                </div>
                                <div class="mt-4 w-full">
                                    <x-label for="shipping" :value="__('Shipping method')" />
                                    <x-input-select id="shipping" name="shipping_method" class="w-full" required>
                                        @forelse($shippingMethods as $method)
                                            <option value="{{$method->id}}">{{$method->name}}</option>
                                        @empty
                                            <option value="error">{{ __('No shipping methods found, contact administrator')}}</option>
                                        @endforelse
                                    </x-input-select>
                                </div>
                                <div class="mt-4 w-full">
                                    <x-label for="payment_method" :value="__('Payment method')" />
                                    <x-input-select id="payment_method" name="payment_method" class="w-full" required>
                                        <option>PayPal</option>
                                        <option>VISA</option>
                                        <option>Mastercard</option>
                                        <option name="bank">{{ __('Wire transfer') }}</option>
                                    </x-input-select>
                                </div>
                                @guest
                                    <div class="mt-4">
                                        <x-label for="register">
                                            <div class="flex items-center">
                                                <x-checkbox name="register" id="register"/>
                                                <div class="ml-2 text-gray-800">
                                                    {{ __('I would like to register for an account') }}
                                                </div>
                                            </div>
                                        </x-jet-label>
                                    </div>
                                    <div class="mt-4 w-full">
                                        <x-label for="email" :value="__('Email')" />
                                        <x-input id="email" name="email" type="text" value="{{ old('email') }}" required />
                                    </div>
                                @endguest
                                    <button type="submit" class="mt-2 inline-flex items-center w-max text-center text-gray-800 bg-blue-300 border-2 border-transparent py-2 px-6 focus:outline-none transition-colors duration-300 hover:border-blue-800 hover:text-blue-800 rounded" >
                                        <i class="ri-secure-payment-line mr-2"></i> {{ __('Complete order') }}
                                    </button>
                            </form>
                            @if ($errors->any())
                            <div class="rounded-lg p-2 mt-2 bg-blue-300">
                                <x-input-error class="mb-4" :errors="$errors" />
                            </div>
                        @endif
                        </div>
                    </div>
                    @endif
            </div>
        </div>
    </div>
@endsection
