<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Admin Register</h2>
        </div>
        <form class="mt-8 space-y-6" wire:submit.prevent="register">
            <div class="rounded-md shadow-sm -space-y-px">
                <div>
                    <input wire:model="name" type="text" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" placeholder="Name">
                </div>
                <div>
                    <input wire:model="email" type="email" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" placeholder="Email address">
                </div>
                <div>
                    <input wire:model="password" type="password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" placeholder="Password">
                </div>
                <div>
                    <input wire:model="password_confirmation" type="password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" placeholder="Confirm Password">
                </div>
            </div>

            @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

            <div>
                <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-bold rounded-xl text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition shadow-lg shadow-blue-100">
                    Register
                </button>
            </div>

            <div class="mt-6 text-center">
                <p class="text-sm text-slate-600">
                    Already have an account? 
                    <a href="{{ route('admin.login') }}" class="font-bold text-blue-600 hover:text-blue-700 transition">Sign In</a>
                </p>
                <div class="mt-4 pt-4 border-t border-slate-100">
                    <a href="{{ route('home') }}" class="text-xs text-slate-400 hover:text-slate-600">← Back to Home</a>
                </div>
            </div>
        </form>
    </div>
</div>
