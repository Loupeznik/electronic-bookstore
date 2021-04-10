<nav class="p-4 bg-blue-300 border-b-2 border-gray-800 shadow-lg">
	<div class="container flex justify-between h-16 mx-auto">
		<div class="flex">
			<a href="/" aria-label="Back to homepage" class="flex items-center p-2">
                <img src="/logo.png" class="w-16 h-16">
			</a>
			<ul class="items-stretch hidden space-x-3 lg:flex">
                <x-nav-item :link="'/'">{{__('Home')}}</x-nav-item>
                <x-nav-item :link="'/books'">{{__('Books')}}</x-nav-item>
                <!--<x-nav-item :link="'/authors'">{{__('Authors')}}</x-nav-item>-->
                <x-nav-item :link="'/contact'">{{__('Contact')}}</x-nav-item>
			</ul>
		</div> 
		<div class="items-stretch hidden space-x-3 lg:flex">
            @auth
                <x-nav-item :link="'/user/dashboard'">{{__('User Dashboard')}}</x-nav-item>
                @if (Auth::user()->isAdmin())
                    <x-nav-item :link="'/admin/dashboard'">{{__('Admin Dashboard')}}</x-nav-item>
                @endif
            @else
                <x-nav-item :link="'/login'">{{__('Login')}}</x-nav-item>
                <x-nav-item :link="'/register'">{{__('Register')}}</x-nav-item>
            @endauth
			<livewire:cart-status />
		</div>
		<button class="p-4 lg:hidden">
			<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6 dark:text-coolGray-100">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
			</svg>
		</button>
	</div>
</nav>
