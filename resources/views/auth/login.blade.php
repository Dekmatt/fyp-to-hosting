<!-- filepath: /c:/laragon/www/spr-fyp/resources/views/auth/login.blade.php -->
<x-guest-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Archivo+Black&display=swap');

        .flex-center {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background: url('{{ asset('images/login.png') }}') no-repeat center center;
            background-size: cover;
        }
        .content-box {
            background-color: rgba(255, 255, 255, 0.8); /* Mist color with transparency */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 450px;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            transform: translateX(70%); /* Move the box 2/3 to the right */
        }
        .flex-end {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 10px;
            width: 100%;
        }
        .flex-start {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            width: 100%;
        }
        .input-field {
            font-size: 1em; /* Adjust the font size as needed */
            padding: 10px; /* Increase padding for larger input boxes */
            margin-bottom: 15px; /* Add gap between input fields */
            width: 100%; /* Ensure the input fields take the full width */
            max-width: 600px; /* Set a maximum width for the input fields */
        }
        .input-field::placeholder {
            font-size: 1em; /* Adjust the font size as needed */
        }
        .login-heading {
            font-family: 'Archivo Black', sans-serif;
            font-size: 2rem;
        }
        .login-button {
            font-size: 1em; /* Make the button text bigger */
            padding: 10px 20px; /* Increase padding for the button */
            display: flex;
            justify-content: center;
            width: 50%; /* Adjust width as needed */
        }
        .button-container {
            display: flex;
            justify-content: center;
            width: 100%;
        }
        .gap {
            margin-top: 20px; /* Add gap between elements */
        }
        .description {
            font-size: 0.875em; /* Smaller font size for descriptions */
            color: gray; /* Gray color for descriptions */
            margin-top: 5px; /* Small margin above the description */
        }
    </style>

    <div class="flex-center">
        <div class="content-box">
            <h2 class="login-heading text-center text-2xl font-bold mb-4">LOGIN</h2>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form id="login-form" method="POST" action="{{ route('login') }}" onsubmit="return validateForm()">
                @csrf

                <!-- Email Address -->
                <div class="w-full">
                    <x-text-input id="email" class="block mt-1 w-full input-field" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4 w-full">
                    <x-text-input id="password" class="block mt-1 w-full input-field" type="password" name="password" required autocomplete="current-password" placeholder="Password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- 2FA Input (Always Displayed) -->
                <div class="mt-4 w-full">
                    <x-text-input 
                        id="two_factor_code" 
                        class="block mt-1 w-full input-field" 
                        type="text" 
                        name="two_factor_code" 
                        placeholder="Authentication Code"
                        required 
                        maxlength="6"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 6);"
                        autocomplete="off"
                    />
                    <x-input-error :messages="$errors->get('two_factor_code')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4 w-full">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                        <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <!-- Google reCAPTCHA v2 -->
                <div class="mt-4 w-full">
                    <div class="g-recaptcha" data-sitekey="{{ config('services.nocaptcha.sitekey') }}"></div>
                    <x-input-error :messages="$errors->get('g-recaptcha-response')" class="mt-2" />
                </div>

                <div class="button-container gap">
                    <x-primary-button class="login-button">
                        {{ __('Login') }}
                    </x-primary-button>
                </div>

                <div class="flex-start mt-4">
                    <!-- Register Here Link -->
                    <p class="description">Create a new account?</p>
                    <a class="link ms-3" href="{{ route('register') }}">Register Here</a>
                </div>
            </form>

            <!-- reCAPTCHA v2 script -->
            <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        </div>
    </div>
</x-guest-layout>