@extends('layouts.app')

@section('content')
<div class="container">
    <br>
    
    <h1 class="mb-4 text-white">Add New Item</h1>

    <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="category_id" class="form-label text-white">Category</label>
            <select name="category_id" id="category_id" class="form-control bg-dark text-white" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="itemName" class="form-label text-white">Item Name</label>
            <input type="text" name="itemName" class="form-control bg-dark text-white" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label text-white">Price</label>
            <input type="number" name="price" class="form-control bg-dark text-white" required>
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label text-white">Amount</label>
            <input type="number" name="amount" class="form-control bg-dark text-white" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label text-white">Image</label>
            <input type="file" name="image" class="form-control bg-dark text-white" required>
        </div>

        <button type="submit" class="btn btn-success">Add Item</button>
    </form>
</div>
@endsection
