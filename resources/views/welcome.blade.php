<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Home</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="bg-gray-800 text-white flex flex-col min-h-screen">

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                         <li class="nav-item">
                    @auth
                        @if(Auth::user()->role === 'admin')
                            <a class="nav-link active" href="{{ route('admin.dashboard') }}">Dashboard</a>
                        @else
                            <a class="nav-link active" href="{{ route('user.dashboard') }}">Dashboard</a>
                        @endif
                    @else
                        <a class="nav-link active" href="{{ route('dashboard') }}">Dashboard</a>
                    @endauth
                </li>
                    </ul>

                    <!-- Right Side of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        @auth
                            <!-- If User is Logged In -->
                            <li class="nav-item">
                                <span class="nav-link text-dark fw-bold">Welcome, {{ Auth::user()->name }}</span>
                            </li>
                            <li class="nav-item">
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                                </form>
                            </li>
                        @else
                            <!-- If User is Not Logged In -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Register</a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>


        <!-- Main Content -->
        <main class="flex flex-col flex-grow items-center justify-center p-6 text-center">
            <h1 class="text-6xl font-extrabold text-white mb-4">Welcome to Inventory Manager</h1>
            <h3 class="text-5xl text-white max-w-xl">
                Before continuing, please register/login
            </h3>
        </main>

        <div class="container mt-4">
            <div class="card-body">
                <h4 class="mb-3">Available Inventory</h4>
                
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Item Name</th>
                            <th>Category</th>
                            <th>Stock</th>
                            <th>Image</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($inventory as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->itemName }}</td>
                            <td>{{ $item->category->name }}</td>
                            <td>{{ $item->amount }}</td>
                            <td><img src="{{ asset('images/' . $item->image) }}" alt="Item Image" class="img-fluid">
                            </td>
                            <td>Rp. {{ number_format($item->price, 2) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No items available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
