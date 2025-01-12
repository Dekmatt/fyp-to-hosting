<!-- filepath: /c:/laragon/www/spr-fyp/resources/views/auth/register.blade.php -->
<x-guest-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Archivo+Black&display=swap');

        .flex-center {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background: url('{{ asset('images/register.png') }}') no-repeat center center;
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
            transform: translateX(-70%); /* Move the box 2/3 to the right */
        }
        .input-field {
            font-size: 1em; /* Adjust the font size as needed */
            padding: 10px; /* Increase padding for larger input boxes */
            margin-bottom: 15px; /* Add gap between input fields */
            width: 100%; /* Ensure the input fields take the full width */
            max-width: 500px; /* Set a maximum width for the input fields */
            text-align: left; /* Align text to the left */
        }
        .input-field::placeholder {
            font-size: 1em; /* Adjust the font size as needed */
            text-align: left; /* Align placeholder text to the left */
        }
        .register-heading {
            font-family: 'Archivo Black', sans-serif;
            font-size: 2rem;
            align-self: center; /* Center the heading */
        }
        .register-button {
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
    </style>

    <div class="flex-center">
        <div class="content-box">
            <h2 class="register-heading text-center text-2xl font-bold mb-4">REGISTER</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="w-full">
                    <x-text-input id="name" class="block mt-1 w-full input-field" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4 w-full">
                    <x-text-input id="email" class="block mt-1 w-full input-field" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4 w-full">
                    <x-text-input id="password" class="block mt-1 w-full input-field" type="password" name="password" required autocomplete="new-password" placeholder="Password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4 w-full">
                    <x-text-input id="password_confirmation" class="block mt-1 w-full input-field" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="button-container mt-4">
                    <x-primary-button class="register-button">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>

                <div class="mt-4">
                    <p class="description">Already Have Account?</p>
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                        {{ __('Login Here') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>