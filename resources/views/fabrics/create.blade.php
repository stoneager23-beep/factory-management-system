@extends('layouts.app')
@section('content')
    <div class="container">
        <h2>Add New Fabric</h2>

        <form action="{{ route('fabrics.store') }}" method="POST">
        @csrf

        <!-- Fabric Name -->
            <div class="mb-3">
                <label for="name" class="form-label">Fabric Name</label>
                <input type="text" name="name" class="form-control" placeholder="e.g. Cotton, Denim" required>
            </div>

            <!-- Quantity -->
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" step="0.01" name="quantity" class="form-control" placeholder="Enter quantity" required>
            </div>

            <!-- Unit (Meters / Yards / Kgs) -->
            <div class="mb-3">
                <label for="unit" class="form-label">Unit</label>
                <select name="unit" class="form-select" required>
                    <option value="meters">Meters</option>
                    <option value="yards">Yards</option>
                    <option value="kgs">Kgs</option>
                </select>
            </div>
            <!-- Color -->
            <div class="mb-3">
                <label for="color" class="form-label">Color</label>
                <input type="text" name="color" class="form-control" value="{{ old('color') }}">
            </div>

            <!-- Unit Price -->
            <div class="mb-3">
                <label for="unit_price" class="form-label">Unit Price</label>
                <input type="number" step="0.01" name="unit_price" class="form-control" value="{{ old('unit_price') }}"placeholder="Price per unit" required>
            </div>




            <!-- Supplier -->
            <div class="mb-3">
                <label for="supplier" class="form-label">Supplier</label>
                <input type="text" name="supplier" class="form-control" placeholder="Enter supplier name">
            </div>

            <button type="submit" class="btn btn-primary">Save Fabric</button>
            <a href="{{ route('fabrics.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
