<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous">
</head>

<body class="antialiased">
<style>
        body {
            font-family: 'Playfair Display', serif;
            transition: opacity 0.5s ease-in-out;
            background-color: #f5f5f5;
        }

        section {
            width: 100%;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
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

        .bg-glass {
            background-color: hsla(0, 0%, 100%, 0.8) !important;
            backdrop-filter: saturate(150%) blur(30px);
            border-radius: 15px;
        }

        .register-link {
            text-align: center;
            margin-top: 5px;
        }

        .register-link a {
            color: #d4af37 !important; /* Warna emas */
            text-decoration: underline !important;
            cursor: pointer;
            font-weight: 600;
        }

        .register-link a:hover {
            text-decoration: none;
            color: #b8860b !important; /* Warna emas gelap */
            transition: color 0.3s ease;
        }

        .btn-primary {
            background-color: #d4af37 !important; /* Warna emas */
            border: none;
        }

        .btn-primary:hover {
            background-color: #b8860b !important;
            transition: background-color 0.3s ease;
        }

        h1.title,
        h1.title span {
            color: white; /* Warna putih hanya untuk judul dan subjudul */
        }
    </style>


    <section>
        <!-- Video Background -->
        <video class="video-background" autoplay muted loop>
            <source src="{{ asset('public/video/video.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
            <div class="row gx-lg-5 align-items-center mb-5">
                <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
                    <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(207, 91%, 95%)">
                        Baratie Resto<br />
                        <span style="color: #d4af37;">Enjoy the Taste for Better Experience</span>
                    </h1>
                </div>
                <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
                    <div class="card bg-glass">
                        <div class="card-body px-4 py-5 px-md-5">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('login') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <h4 class="mb-3 text-center">LOGIN <i class="fa-solid fa-user"></i> </h4>

                            <div class="form-floating mb-2">
                                <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                                <label for="email">Email</label>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-floating mb-2">
                                <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                                <label for="password">Password</label>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" style="width: 100%;" class="btn btn-primary btn-block mb-2 mt-3">
                                Login
                            </button>
                        </form>

                            <!-- Register Link -->
                            <div class="register-link">
                                <span>Belum punya akun? <a href="{{ url('web/register') }}">Klik di sini</a></span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

       <script>
        document.getElementById('loginForm').addEventListener('submit', function (e) {
            e.preventDefault(); // Prevent form from submitting normally

            const username = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            // Check if username is 'admin'
            if (username === 'admin@gmail.com' && password === 'admin12345' ) {
                window.location.href = "/admin"; // Redirect to admin page
            } else {
                window.location.href = "web/home"; // Redirect to home page
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDMNeT87bh950GNyZPhcTNXj1W7RuBCsyN/o@jlpcV8Qyq46cDFL"
        crossorigin="anonymous"></script>
</body>

</html>