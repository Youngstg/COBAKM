<style>
    .form-control:focus {
        border-color: #189AC5;
        box-shadow: 0 0 0 0.2rem rgba(24, 154, 197, 0.25);
    }
</style>

<x-client>
    <main class="flex-grow flex items-center justify-center px-4 min-h-[70vh]">
        <div class="max-w-md w-full bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-[#189AC5] text-[#FAFAFA] text-center py-4 rounded-t-lg">
                <h2 class="text-xl font-semibold">{{ __('Login') }}</h2>
            </div>
            <div class="p-6">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-4">
                        @if ($errors->has('failed'))
                            <span class="text-red-500 text-sm block text-center">{{ $errors->first('failed') }}</span>
                        @endif
                        <label for="email"
                            class="block text-sm font-medium text-gray-700">{{ __('Email Address') }}</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            autocomplete="email" autofocus
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-[#189AC5] focus:border-[#189AC5] sm:text-sm">
                        @error('email')
                            <span class="text-red-500 text-sm mt-2 block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="password"
                            class="block text-sm font-medium text-gray-700">{{ __('Password') }}</label>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-[#189AC5] focus:border-[#189AC5] sm:text-sm">
                        @error('password')
                            <span class="text-red-500 text-sm mt-2 block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4 flex items-center">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}
                            class="h-4 w-4 text-[#189AC5] focus:ring-[#189AC5] border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-900">{{ __('Remember Me') }}</label>
                    </div>
                    <div class="flex items-center justify-between">
                        <button type="submit"
                            class="bg-[#EDBC48] text-white py-2 px-4 rounded-md shadow-sm hover:bg-[#D4A93E] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#189AC5]">{{ __('Login') }}</button>
                        @if (Route::has('password.request'))
                            <a class="text-sm text-[#189AC5] hover:text-[#2575fc]"
                                href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </main>
</x-client>

</html>