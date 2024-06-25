<x-guest-layout>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
      <img src="/img/logo.png" width="30%" class="mx-auto my-2">
      <h2 class="text-center my-2" style="font-size:24px;font-weight:bold">Sign Up</h2>
      <p class="text-center">Enter your email and to register</p>
  <form method="POST" action="{{ route('register') }}">
      @csrf

      <!-- Name -->
      <div>
          <x-input-label for="name" :value="__('Name')" />
          <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
              required autofocus autocomplete="name" />
          <x-input-error :messages="$errors->get('name')" class="mt-2" />
      </div>

      <!-- Email Address -->
      <div class="mt-4">
          <x-input-label for="email" :value="__('Email')" />
          <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
              required autocomplete="username" />
          <x-input-error :messages="$errors->get('email')" class="mt-2" />
      </div>

      <!-- Password -->
      <div class="mt-4">
          <x-input-label for="password" :value="__('Password')" />
          <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
              autocomplete="new-password" />
          <x-input-error :messages="$errors->get('password')" class="mt-2" />
      </div>

      <!-- Confirm Password -->
      <div class="mt-4">
          <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
          <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
              name="password_confirmation" required autocomplete="new-password" />
          <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
      </div>

      <!-- Role Selection -->
      <div class="mt-4">
        <x-input-label for="role" :value="__('Role')" />
        <select id="role" name="role" class="form-select block mt-1 w-full" required>
            <option value="user" selected>{{ __('User') }}</option>
        </select>
        <x-input-error :messages="$errors->get('role')" class="mt-2" />
    </div>
    

      <div class="flex items-center justify-end mt-4">
          <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
              href="{{ route('login') }}">
              {{ __('Already registered?') }}
          </a>

          <x-primary-button class="ms-4" style="background:#00A9E0;">
              {{ __('Register') }}
          </x-primary-button>
      </div>
  </form>
</x-guest-layout>
