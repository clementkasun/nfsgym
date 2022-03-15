<style>
    body {
        background-color: #184daf !important;
    }
</style>
<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <img style="width: 240px; height: 85px;" src="../../dist/img/nfgym.png">
            <p style="color: white;"><b> Natural Fitness Gym </b></p>
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <input id="remember_me" type="checkbox" class="form-checkbox" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
                @endif
                <x-jet-button class="ml-4">
                    {{ __('Login') }}
                </x-jet-button>
                <!--                <x-jet-button class="ml-4">
                    <a href="/register" class="btn btn-md bg-dark">Register</a>
                </x-jet-button>-->
            </div>
        </form>
        <script>
        </script>
    </x-jet-authentication-card>
</x-guest-layout>