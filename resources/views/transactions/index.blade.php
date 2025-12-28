<?php
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-between mb-3">
            <h2>Inventory Transactions</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#transactionModal">+ Add Transaction</button>
        </div>

        <input type="text" id="searchTransaction" class="form-control mb-3" placeholder="Search by Article...">
        <div id="transactionsTable">
            @include('transactions.partials.table', ['transactions' => $transactions])
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="transactionModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('InventoryTransaction') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add Transaction</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3"><label class="form-label">Article ID</label><input type="number" name="article_id" class="form-control" required></div>
                        <div class="mb-3"><label class="form-label">Type</label>
                            <select name="type" class="form-select" required>
                                <option value="purchase">Purchase</option>
                                <option value="issue">Issue</option>
                                <option value="adjustment">Adjustment</option>
                            </select>
                        </div>
                        <div class="mb-3"><label class="form-label">Quantity</label><input type="number" step="0.01" name="quantity" class="form-control" required></div>
                        <div class="mb-3"><label class="form-label">Unit</label><input type="text" name="unit" class="form-control" required></div>
                    </div>
                    <div class="modal-footer"><button type="submit" class="btn btn-success">Save</button></div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById("searchTransaction").addEventListener("keyup", function() {
            fetch("{{ route('transactions.search') }}?q=" + this.value)
                .then(res => res.text())
                .then(data => document.getElementById("transactionsTable").innerHTML = data);
        });
    </script>
@endpush
