@extends('layouts.app')

@section('content')
<div class="container">
    <br>
    
    <h1 class="mb-4 text-white">Edit Item</h1>

    <form action="{{ route('admin.update', $inventory->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')


        <div class="mb-3">
            <label for="category_id" class="form-label text-white">Category</label>
            <select name="category_id" id="category_id" class="form-control bg-dark text-white" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $inventory->category_id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="itemName" class="form-label text-white">Item Name</label>
            <input type="text" name="itemName" class="form-control bg-dark text-white" value="{{ $inventory->itemName }}" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label text-white">Price</label>
            <input type="number" name="price" class="form-control bg-dark text-white" value="{{ $inventory->price }}" required>
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label text-white">Amount</label>
            <input type="number" name="amount" class="form-control bg-dark text-white" value="{{ $inventory->amount }}" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label text-white">Image</label>
            <input type="file" name="image" class="form-control bg-dark text-white">
            <br>
            <img src="{{ asset('images/' . $inventory->image) }}" alt="Item Image" class="img-fluid">
        </div>

        <button type="submit" class="btn btn-success">Update Item</button>
    </form>
</div>
@endsection
