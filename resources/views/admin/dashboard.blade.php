@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Admin Dashboard</h1>
    <a href="{{ route('user.dashboard') }}" class="btn btn-primary mb-3">Go to User Dashboard</a>
    <a href="{{ route('admin.create') }}" class="btn btn-primary mb-3">Add New Item</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Category</th>
                <th>Item Name</th>
                <th>Price</th>
                <th>Amount</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inventory as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->category->name }}</td>
                    <td>{{ $item->itemName }}</td>
                    <td>Rp{{ number_format($item->price, 2) }}</td>
                    <td>{{ $item->amount }}</td>
                    <td><img src="{{ asset('images/' . $item->image) }}" alt="Item Image" class="img-fluid"></td>
                    <td>
                        <a href="{{ route('admin.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.delete', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
