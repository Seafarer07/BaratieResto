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

        .form-control.is-invalid {
            border-color: red;
            box-shadow: 0 0 5px rgba(255, 0, 0, 0.5);
        }

        .invalid-feedback {
            color: red;
            font-size: 0.875em;
        }
    </style>
</head>

<body>
    <section>
        <video class="video-background" autoplay muted loop>
            <source src="{{ asset('public/video/video.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <div class="card shadow-lg">
            <div class="card-body px-4 py-5">
                <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <h4 class="mb-4 text-center">REGISTER</h4>

                    <!-- Nama Pengguna -->
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('nama_pelanggan') is-invalid @enderror" id="nama_pelanggan" name="nama_pelanggan" placeholder="Masukan Nama Anda" value="{{ old('nama_pelanggan') }}" />
                        <label for="nama_pelanggan">Nama User</label>
                        @error('nama_pelanggan')
                            <div class="invalid-feedback">Nama pengguna ini sudah diambil.</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Masukan Email Anda" value="{{ old('email') }}" />
                        <label for="email">Email</label>
                        @error('email')
                            <div class="invalid-feedback">Email ini sudah terdaftar.</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Masukan Password" />
                        <label for="password">Password</label>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Telepon -->
                    <div class="form-floating mb-3">
                        <input type="tel" class="form-control @error('telepon') is-invalid @enderror" id="telepon" name="telepon" placeholder="Masukan Nomor Telepon" pattern="[0-9]{10,15}" value="{{ old('telepon') }}" />
                        <label for="telepon">Nomor Telepon</label>
                        @error('telepon')
                            <div class="invalid-feedback">Nomor telepon ini sudah digunakan.</div>
                        @enderror
                    </div>

                    <!-- Upload Gambar -->
                    <div class="form-floating mb-3">
                        <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar" name="gambar">
                        <label for="gambar">Upload Gambar</label>
                        @error('gambar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit & Cancel Buttons -->
                    <div class="d-flex justify-content-between">
                        <button type="reset" class="btn btn-secondary" style="width: 48%;">Cancel</button>
                        <button type="submit" class="btn btn-success" style="width: 48%;">
                            <i class="fa-solid fa-floppy-disk"></i> Register
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <div class="notification" id="notification"></div>

    <script>
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