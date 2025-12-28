@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Accessory</h2>

        <form method="POST" action="{{ route('accessories.update', $accessory->id) }}">
        @csrf
        @method('PUT')

        <!-- Name -->
            <div class="mb-3">
                <label for="name" class="form-label">Accessory Name</label>
                <input type="text" name="name" id="name"
                       class="form-control"
                       value="{{ old('name', $accessory->name) }}" required>
            </div>

            <!-- Type -->
            <div class="mb-3">
                <label for="type" class="form-label">Type</label>
                <input type="text" name="type" id="type"
                       class="form-control"
                       value="{{ old('type', $accessory->type) }}">
            </div>

            <!-- Color -->
            <div class="mb-3">
                <label for="color" class="form-label">Color</label>
                <input type="text" name="color" id="color"
                       class="form-control"
                       value="{{ old('color', $accessory->color) }}">
            </div>

            <!-- Quantity -->
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" step="0.01" name="quantity" id="quantity"
                       class="form-control"
                       value="{{ old('quantity', $accessory->quantity) }}" required>
            </div>

            <!-- Unit -->
            <div class="mb-3">
                <label for="unit" class="form-label">Unit</label>
                <select name="unit" id="unit" class="form-control" required>
                    <option value="pieces" {{ $accessory->unit == 'pieces' ? 'selected' : '' }}>Pieces</option>
                    <option value="meters" {{ $accessory->unit == 'meters' ? 'selected' : '' }}>Meters</option>
                    <option value="yards" {{ $accessory->unit == 'yards' ? 'selected' : '' }}>Yards</option>
                    <option value="kgs" {{ $accessory->unit == 'kgs' ? 'selected' : '' }}>Kgs</option>
                </select>
            </div>

            <!-- Unit Price -->
            <div class="mb-3">
                <label for="unit_price" class="form-label">Unit Price</label>
                <input type="number" step="0.01" name="unit_price" id="unit_price"
                       class="form-control"
                       value="{{ old('unit_price', $accessory->unit_price) }}">
            </div>

            <!-- Supplier -->
            <div class="mb-3">
                <label for="supplier" class="form-label">Supplier</label>
                <input type="text" name="supplier" id="supplier"
                       class="form-control"
                       value="{{ old('supplier', $accessory->supplier) }}">
            </div>

            <!-- Buttons -->
            <div class="d-flex justify-content-between">
                <a href="{{ route('accessories.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-success">Update Accessory</button>
            </div>
        </form>
    </div>
@endsection
