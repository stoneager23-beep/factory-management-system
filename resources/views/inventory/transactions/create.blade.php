@extends('layouts.app')

@section('page-title','New Inventory Transaction')
@section('page-subtitle','Record a purchase, issue, or adjustment')

@section('content')
    <div class="container">
        <div class="card shadow-sm rounded">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">New Inventory Transaction</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('transactions.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">

                        <!-- Item Type -->
                        <div class="col-md-6">
                            <label class="form-label">Item Type</label>
                            <select name="inventoryable_type" class="form-select">
                                <option value="App\Models\Fabric">Fabric</option>
                                <option value="App\Models\Accessory">Accessory</option>
                            </select>
                        </div>

                        <!-- Item ID -->
                        <div class="col-md-6">
                            <label class="form-label">Item ID</label>
                            <input type="number" name="inventoryable_id" class="form-control" placeholder="Enter Fabric/Accessory ID">
                        </div>

                        <!-- Transaction Type -->
                        <div class="col-md-6">
                            <label class="form-label">Transaction Type</label>
                            <select name="type" class="form-select">
                                <option value="purchase">Purchase</option>
                                <option value="issue">Issue</option>
                                <option value="adjustment">Adjustment</option>
                            </select>
                        </div>

                        <!-- Quantity -->
                        <div class="col-md-6">
                            <label class="form-label">Quantity</label>
                            <input type="number" step="0.01" name="quantity" class="form-control">
                        </div>

                        <!-- Unit -->
                        <div class="col-md-6">
                            <label class="form-label">Unit</label>
                            <select name="unit" class="form-select">
                                <option value="meters">Meters</option>
                                <option value="yards">Yards</option>
                                <option value="kgs">Kgs</option>
                                <option value="pcs">Pcs</option>
                            </select>
                        </div>

                        <!-- Unit Price -->
                        <div class="col-md-6">
                            <label class="form-label">Unit Price</label>
                            <input type="number" step="0.01" name="unit_price" class="form-control" value="0">
                        </div>

                        <!-- Article (optional) -->
                        <div class="col-md-6">
                            <label class="form-label">Article (optional)</label>
                            <input type="number" name="article_id" class="form-control" placeholder="Article ID">
                        </div>

                        <!-- Payment Method -->
                        <div class="col-md-6">
                            <label class="form-label">Payment Method</label>
                            <select name="payment_method" class="form-select">
                                <option value="">--</option>
                                <option value="cash">Cash</option>
                                <option value="credit">Credit</option>
                            </select>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('transactions.index') }}" class="btn btn-secondary me-2">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Record Transaction
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
