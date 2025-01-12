<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Two-Factor Authentication</title>
    <style>
        body {
            display: flex;
            align-items: center; /* Center vertically */
            justify-content: flex-start; /* Align to the left */
            height: 100vh;
            background: url('{{ asset('images/2fa.png') }}') no-repeat center center;
            background-size: cover;
            margin: 0;
            font-family: Arial, sans-serif;
            padding-left: 5%; /* Adjust this value to move the box to the left middle */
        }

        .container {
            background-color: rgba(255, 255, 255, 0.8); /* Mist color with transparency */
            padding: 30px; /* Increase padding */
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
            font-size: 1em; /* Increase font size */
        }

        .container h1 {
            font-size: 1.5em; /* Increase heading size */
        }

        .container p {
            font-size: 1em; /* Increase paragraph size */
        }

        .container input {
            font-size: 1em; /* Increase input font size */
            padding: 10px; /* Increase input padding */
            margin-top: 20px; /* Add gap between the QR code and the input box */
        }

        .container button {
            font-size: 1em; /* Increase button font size */
            padding: 10px 20px; /* Increase button padding */
        }

        .error-message {
            color: red;
            font-size: 1em; /* Increase error message size */
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Two-Factor Authentication</h1>

        {{-- Display Secret Key --}}
        <p><strong>Secret Key:</strong> {{ $secret }}</p>

        {{-- Generate and display the QR code --}}
        <p><strong>Scan this QR code with your authentication app:</strong></p>
        <div>
            <src>{!! QrCode::size(200)->generate($qrCodeUrl) !!}</src>
        </div>

        {{-- Modal Message Box for Entering 2FA Code --}}
        <form method="POST" action="{{ route('2fa.verify') }}">
            @csrf
            <input type="text" id="2faCode" name="2faCode" class="modal-input" placeholder="Enter 2FA Code" maxlength="6" oninput="validateInput(event)" />
            <button type="submit" id="confirmBtn">Confirm</button>
            <div>
                @if (session('error'))
                <span class="error-message">{{ session('error') }}</span>
                @endif
            </div>
        </form>
    </div>

    <script>
        // Validate input to ensure only numbers are entered
        function validateInput(event) {
            // Remove any non-numeric characters
            event.target.value = event.target.value.replace(/\D/g, '');
        }
    </script>
</body>
</html>