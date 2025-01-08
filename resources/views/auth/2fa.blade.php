<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Two-Factor Authentication</title>
    <style>
        /* Style for the modal */
        .modal {
            display: none; 
            position: fixed;
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            background-color: rgba(0, 0, 0, 0.5); 
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
        }

        .modal-button {
            padding: 10px 20px;
            margin: 10px;
            cursor: pointer;
            border: none;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
        }

        .modal-button.cancel {
            background-color: #dc3545;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>Two-Factor Authentication</h1>

    {{-- Display Secret Key --}}
    <p><strong>Secret Key:</strong> {{ $secret }}</p>

    {{-- Generate and display the QR code --}}
    <p><strong>Scan this QR code with your authentication app:</strong></p>
    <div>
        <src>{!! QrCode::size(200)->generate($qrCodeUrl) !!}
    </div>

    {{-- Button to show the message box --}}
    <button class="modal-button" id="openModalBtn">Login</button>

    {{-- Modal Message Box for Entering 2FA Code --}}
<form method="POST" action="{{ route('2fa.verify') }}">
    @csrf
    <input type="text" id="2faCode" name="2faCode" class="modal-input" placeholder="Enter 2FA Code" maxlength="6" />
    <span id="error-message" style="display:none; color:red;">Incorrect 2FA code</span>
    <button type="submit" id="confirmBtn">Confirm</button>
</form>

    <script>
        // Validate input to ensure only numbers are entered
        function validateInput(event) {
            // Remove any non-numeric characters
            event.target.value = event.target.value.replace(/\D/g, '');
        }

        // Get modal and buttons
        const modal = document.getElementById("modal");
        const openModalBtn = document.getElementById("openModalBtn");
        const cancelBtn = document.getElementById("cancelBtn");
        const confirmBtn = document.getElementById("confirmBtn");
        const errorMessage = document.getElementById("error-message");

        // Open the modal
        openModalBtn.onclick = function() {
            modal.style.display = "block";
        };

        // Close the modal (Cancel button)
        cancelBtn.onclick = function() {
            modal.style.display = "none";
        };

        // Redirect to login page (Confirm button)
        confirmBtn.onclick = function() {
            const code = document.getElementById("2faCode").value;

            // Check if the code is exactly 6 digits
            if (code.length !== 6) {
                // Show error message if the code is not 6 digits
                errorMessage.style.display = "block";
            } else {
                // Hide error message and redirect to login page
                errorMessage.style.display = "none";
                window.location.href = "/login"; // Replace with the correct login route
            }
        };

        // Close modal if clicked outside of modal content
        window.onclick = function(event) {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        };
    </script>
</body>
</html>
