@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3>Welcome, {{ Auth::user()->name }}</h3>
            <p class="mb-0">Email: {{ Auth::user()->email }}</p>
            @if(Auth::user()->role === 'admin')  
                <a href="{{ route('admin.dashboard') }}" class="btn btn-warning">Go to Admin Dashboard</a>
            @endif
        </div>
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
                        <th>Action</th>
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
                        <td>${{ number_format($item->price, 2) }}</td>
                        <td>
                            <form action="{{ route('user.buy', $item->id) }}" method="POST">
                                @csrf
                                <input type="number" name="buy_amount" min="1" max="{{ $item->amount }}" value="1" class="form-control d-inline-block w-50" required>
                                <button type="submit" class="btn btn-sm btn-success">Buy</button>
                            </form>
                        </td>
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
</div>
@endsection
