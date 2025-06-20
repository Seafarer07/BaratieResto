<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous">
</head>

<body class="antialiased">
    <style>
        body {
            font-family: 'Playfair Display', serif;
            background-color: #f5f5f5;
            transition: opacity 0.5s ease-in-out;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }

        section {
            width: 100%;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            box-sizing: border-box;
        }

        .video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        .card {
            width: 100%;
            max-width: 600px;
            padding: 40px;
            margin: 20px;
            border-radius: 15px;
            background-color: hsla(0, 0%, 100%, 0.8);
            backdrop-filter: saturate(150%) blur(30px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        h4 {
            font-weight: 600;
            color: #333;
        }

        label {
            color: #666;
        }

        .btn-cancel {
            background-color: #b8860b;
            color: white;
            border: none;
        }

        .btn-cancel:hover {
            background-color: #d4af37;
            transition: background-color 0.3s ease;
        }

        .btn-primary {
            background-color: #d4af37;
            border: none;
        }

        .btn-primary:hover {
            background-color: #b8860b;
            transition: background-color 0.3s ease;
        }

        .notification {
            position: fixed;
            top: 10px;
            right: 10px;
            background-color: green;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            display: none;
            z-index: 9999;
        }

        .notification.error {
            background-color: red;
        }
    </style>

    <section>
        <video class="video-background" autoplay muted loop>
            <source src="{{ asset('video/video.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <div class="card shadow-lg">
            <div class="card-body px-4 py-5">
                <form id="registerForm">
                    <h4 class="mb-4 text-center">REGISTER</h4>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="regUsername" placeholder="Username" required />
                        <label for="regUsername">Username</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="regEmail" placeholder="Email" required />
                        <label for="regEmail">Email</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="regPassword" placeholder="Password" required />
                        <label for="regPassword">Password</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="regPasswordConfirm"
                            placeholder="Confirm Password" required />
                        <label for="regPasswordConfirm">Confirm Password</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="regBirthDate" placeholder="Tanggal Lahir" required />
                        <label for="regBirthDate">Tanggal Lahir</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="tel" class="form-control" id="regPhone" placeholder="Nomor Telepon"
                            pattern="[0-9]{10,15}" required />
                        <label for="regPhone">Nomor Telepon</label>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-cancel" style="width: 48%;" onclick="resetForm()">Cancel</button>
                        <button type="button" class="btn btn-primary" style="width: 48%;" onclick="validateForm()">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <div class="notification" id="notification"></div>

    <script>
        function resetForm() {
            document.getElementById("registerForm").reset();
        }

        function validateForm() {
            const form = document.getElementById("registerForm");
            const inputs = form.querySelectorAll("input[required]");
            let isValid = true;

            inputs.forEach(input => {
                if (!input.value.trim()) {
                    isValid = false;
                }
            });

            if (isValid) {
                saveForm();
            } else {
                showNotification("Harap isi semua inputan.", "error");
            }
        }

        function saveForm() {
            showNotification("Registrasi berhasil!", "success");

            setTimeout(function () {
                window.location.href = "{{ url('login') }}";
            }, 2000);
        }

        function showNotification(message, type) {
            const notification = document.getElementById("notification");
            notification.textContent = message;

            if (type === "error") {
                notification.classList.add("error");
            } else {
                notification.classList.remove("error");
            }

            notification.style.display = "block";

            setTimeout(function () {
                notification.style.display = "none";
            }, 3000);
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDMNeT87bh950GNyZPhcTNXj1W7RuBCsyN/o@jlpcV8Qyq46cDFL"
        crossorigin="anonymous"></script>
</body>

</html>
