@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow-lg border-0 rounded-3">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Edit Fabric</h4>
                    </div>
                    <div class="card-body p-4">

                        <form action="{{ route('fabrics.update', $fabric->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Fabric Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold">Fabric Name</label>
                                <input type="text" name="name" class="form-control"
                                       value="{{ old('name', $fabric->name) }}" required>
                            </div>

                            <!-- Quantity -->
                            <div class="mb-3">
                                <label for="quantity" class="form-label fw-bold">Quantity</label>
                                <input type="number" step="0.01" name="quantity"
                                       class="form-control"
                                       value="{{ old('quantity', $fabric->quantity) }}" required>
                            </div>

                            <!-- Unit -->
                            <div class="mb-3">
                                <label for="unit" class="form-label fw-bold">Unit</label>
                                <select name="unit" class="form-select" required>
                                    <option value="meters" {{ $fabric->unit == 'meters' ? 'selected' : '' }}>Meters</option>
                                    <option value="yards" {{ $fabric->unit == 'yards' ? 'selected' : '' }}>Yards</option>
                                    <option value="kgs" {{ $fabric->unit == 'kgs' ? 'selected' : '' }}>Kgs</option>
                                </select>
                            </div>

                            <!-- Color -->
                            <div class="mb-3">
                                <label for="color" class="form-label fw-bold">Color</label>
                                <input type="text" name="color" class="form-control"
                                       value="{{ old('color', $fabric->color) }}">
                            </div>

                            <!-- Unit Price -->
                            <div class="mb-3">
                                <label for="unit_price" class="form-label fw-bold">Unit Price</label>
                                <input type="number" step="0.01" name="unit_price"
                                       class="form-control"
                                       value="{{ old('unit_price', $fabric->unit_price) }}" required>
                            </div>

                            <!-- Supplier -->
                            <div class="mb-3">
                                <label for="supplier" class="form-label fw-bold">Supplier</label>
                                <input type="text" name="supplier" class="form-control"
                                       value="{{ old('supplier', $fabric->supplier) }}">
                            </div>

                            <!-- Buttons -->
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('fabrics.index') }}" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-success">Update Fabric</button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
