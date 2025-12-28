@extends('layouts.app')
@section('page-title','Edit Invoice')

@section('content')
    <div class="container">
        <h2>Edit Invoice #{{ $invoice->invoice_number }}</h2>

        <form action="{{ route('invoices.update', $invoice) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Invoice Info --}}
            <div class="mb-3">
                <label for="customer_id" class="form-label">Customer</label>
                <select name="customer_id" id="customer_id" class="form-select">
                    <option value="">-- Select Customer --</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" @if($invoice->customer_id == $customer->id) selected @endif>
                            {{ $customer->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-select" required>
                    <option value="draft" @selected($invoice->status == 'draft')>Draft</option>
                    <option value="pending_approval" @selected($invoice->status == 'pending_approval')>Pending Approval</option>
                    <option value="approved" @selected($invoice->status == 'approved')>Approved</option>
                    <option value="paid" @selected($invoice->status == 'paid')>Paid</option>
                </select>
            </div>

            <hr>

            {{-- Items --}}
            <h4>Invoice Items</h4>
            <table class="table" id="items_table">
                <thead>
                <tr>
                    <th>Description</th>
                    <th>Qty</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($invoice->items as $i => $item)
                    <tr>
                        <td><input type="text" name="items[{{ $i }}][description]" class="form-control" value="{{ $item->description }}" required></td>
                        <td><input type="number" name="items[{{ $i }}][qty]" class="form-control qty" value="{{ $item->qty }}" min="1" step="1" required></td>
                        <td><input type="number" name="items[{{ $i }}][unit_price]" class="form-control unit_price" value="{{ $item->unit_price }}" min="0" step="0.01" required></td>
                        <td><input type="text" name="items[{{ $i }}][total]" class="form-control total" value="{{ $item->total }}" readonly></td>
                        <td><button type="button" class="btn btn-danger btn-sm remove-row">X</button></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="mb-4">
                <label class="block text-gray-700">Customer</label>
                <select name="customer_id" class="w-full border-gray-300 rounded-md">
                    <option value="">-- Select Customer --</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}"
                            {{ old('customer_id', $invoice->customer_id ?? '') == $customer->id ? 'selected' : '' }}>
                            {{ $customer->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="button" class="btn btn-secondary mb-3" id="add_row">+ Add Item</button>

            <div class="mb-3 text-end">
                <button type="submit" class="btn btn-primary">Update Invoice</button>
            </div>
        </form>
    </div>

    {{-- JS same as create --}}
    <script>
        let row = {{ count($invoice->items) }};
        document.getElementById('add_row').addEventListener('click', function () {
            let table = document.querySelector('#items_table tbody');
            let newRow = `
        <tr>
            <td><input type="text" name="items[${row}][description]" class="form-control" required></td>
            <td><input type="number" name="items[${row}][qty]" class="form-control qty" min="1" step="1" required></td>
            <td><input type="number" name="items[${row}][unit_price]" class="form-control unit_price" min="0" step="0.01" required></td>
            <td><input type="text" name="items[${row}][total]" class="form-control total" readonly></td>
            <td><button type="button" class="btn btn-danger btn-sm remove-row">X</button></td>
        </tr>
    `;
            table.insertAdjacentHTML('beforeend', newRow);
            row++;
        });

        // Remove row
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-row')) {
                e.target.closest('tr').remove();
            }
        });

        // Auto calculate line total
        document.addEventListener('input', function (e) {
            if (e.target.classList.contains('qty') || e.target.classList.contains('unit_price')) {
                let row = e.target.closest('tr');
                let qty = parseFloat(row.querySelector('.qty').value) || 0;
                let price = parseFloat(row.querySelector('.unit_price').value) || 0;
                row.querySelector('.total').value = (qty * price).toFixed(2);
            }
        });
    </script>
@endsection
