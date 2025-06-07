<x-auth>
    @php
        $role = $role ?? request('role', 'recipient');
    @endphp

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Role Selection -->
        @props(['role'])

        @php
            $initialRole = old('role', $role ?? 'recipient');
            $lockedRole = request()->has('role');
        @endphp

        <div x-data="{ role: '{{ $initialRole }}' }" class="mt-4">
            <input type="hidden" name="role" :value="role" />

            @unless($lockedRole)
                <x-input-label for="role" :value="'Role'" />

                <div class="mt-2 flex gap-4">
                    <button
                        type="button"
                        @click="role = 'recipient'"
                        :class="role === 'recipient'
                    ? 'bg-indigo-600 text-white border-indigo-600'
                    : 'bg-white text-gray-800 border-gray-300'"
                        class="border px-4 py-2 rounded-md text-sm font-medium shadow-sm transition"
                    >
                        Recipient
                    </button>

                    <button
                        type="button"
                        @click="role = 'donor'"
                        :class="role === 'donor'
                    ? 'bg-indigo-600 text-white border-indigo-600'
                    : 'bg-white text-gray-800 border-gray-300'"
                        class="border px-4 py-2 rounded-md text-sm font-medium shadow-sm transition"
                    >
                        Donor
                    </button>
                </div>
            @endunless

            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                          :value="old('name', session('guest_name'))" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone -->
        <div class="mt-4">
            <x-input-label for="phone" :value="'Phone'" />
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-auth>
