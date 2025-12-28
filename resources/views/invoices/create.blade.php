@extends('layouts.app')
@section('page-title','Create Invoice')

@section('content')
    <div class="container">
        <h2>Create Invoice</h2>

        <form action="{{ route('invoices.store') }}" method="POST">
            @csrf

            {{-- Invoice Info --}}
            <div class="mb-3">
                <label class="form-label">Invoice Number</label>
                <input type="text"
                       name="invoice_number"
                       value="{{ $new_number }}"
                       class="form-control"
                       readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Customer</label>
                <select name="customer_id" class="form-select" required>
                    <option value="">-- Select Customer --</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}">
                            {{ $customer->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-check mb-3">
                <input type="checkbox" name="with_gst" value="1" class="form-check-input">
                <label class="form-check-label">Include GST (18%)</label>
            </div>

            <hr>

            {{-- Invoice Items --}}
            <h4>Items</h4>

            <table class="table" id="items_table">
                <thead>
                <tr>
                    <th>Article</th>
                    <th>Qty</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                <tr>
                    <td>
{{--                        @dd($articles)--}}
                        <select name="items[0][article_id]" class="form-select" required>
                            <option value="">-- Select Article --</option>
                            @foreach($articles as $article)
                                <option value="{{ $article->id }}">
                                    {{ $article->article_number }}
                                </option>
                            @endforeach
                        </select>
                    </td>

                    <td>
                        <input type="number"
                               name="items[0][quantity]"
                               class="form-control quantity"
                               min="1"
                               required>
                    </td>

                    <td>
                        <input type="number"
                               name="items[0][unit_price]"
                               class="form-control unit_price"
                               min="0"
                               step="0.01"
                               required>
                    </td>

                    <td>
                        <input type="text" class="form-control total" readonly>
                    </td>

                    <td>
                        <button type="button" class="btn btn-danger btn-sm remove-row">X</button>
                    </td>
                </tr>
                </tbody>
            </table>

            <button type="button" class="btn btn-secondary mb-3" id="add_row">
                + Add Item
            </button>

            <div class="text-end">
                <button type="submit" class="btn btn-success">
                    Save Invoice
                </button>
            </div>
        </form>
    </div>

    {{-- JS --}}
    <script>
        let row = 1;

        document.getElementById('add_row').addEventListener('click', function () {
            let table = document.querySelector('#items_table tbody');

            let newRow = `
        <tr>
            <td>
                <select name="items[${row}][article_id]" class="form-select" required>
                    <option value="">-- Select Article --</option>
                    @foreach($articles as $article)
            <option value="{{ $article->id }}">{{ $article->article_number }}</option>
                    @endforeach
            </select>
        </td>

        <td>
            <input type="number" name="items[${row}][quantity]"
                       class="form-control quantity" min="1" required>
            </td>

            <td>
                <input type="number" name="items[${row}][unit_price]"
                       class="form-control unit_price" min="0" step="0.01" required>
            </td>

            <td>
                <input type="text" class="form-control total" readonly>
            </td>

            <td>
                <button type="button" class="btn btn-danger btn-sm remove-row">X</button>
            </td>
        </tr>`;

            table.insertAdjacentHTML('beforeend', newRow);
            row++;
        });

        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-row')) {
                e.target.closest('tr').remove();
            }
        });

        document.addEventListener('input', function (e) {
            if (e.target.classList.contains('quantity') || e.target.classList.contains('unit_price')) {
                let tr = e.target.closest('tr');
                let qty = parseFloat(tr.querySelector('.quantity').value) || 0;
                let price = parseFloat(tr.querySelector('.unit_price').value) || 0;
                tr.querySelector('.total').value = (qty * price).toFixed(2);
            }
        });
    </script>
@endsection

{{--@extends('layouts.app')--}}
{{--@section('page-title','Create Invoice')--}}

{{--@section('content')--}}
{{--    <div class="container">--}}
{{--        <h2>Create Invoice</h2>--}}

{{--        <form action="{{ route('invoices.store') }}" method="POST">--}}
{{--            @csrf--}}

{{--            --}}{{-- Invoice Info --}}
{{--            <div class="mb-3">--}}
{{--                <label for="invoice_number" class="form-label">Invoice Number</label>--}}
{{--                <input type="text" name="invoice_number" id="invoice_number" value="{{$new_number}}" class="form-control" readonly required>--}}
{{--            </div>--}}

{{--            <div class="mb-3">--}}
{{--                <label for="customer_id" class="form-label">Customer</label>--}}
{{--                <select name="customer_id" id="customer_id" class="form-select">--}}
{{--                    <option value="">-- Select Customer --</option>--}}
{{--                    @foreach($customers as $customer)--}}
{{--                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}
{{--            <div class="mb-4">--}}
{{--                <label class="block text-gray-700">customers</label>--}}
{{--                <select name="customer_id" class="w-full border-gray-300 rounded-md">--}}
{{--                    <option value="">-- Select customers --</option>--}}
{{--                    @foreach($customers as $customer)--}}
{{--                        <option value="{{ $customer->id }}"--}}
{{--                            {{ old('customer_id', $invoice->customer_id ?? '') == $customer->id ? 'selected' : '' }}>--}}
{{--                            {{ $customer->name }}--}}
{{--                        </option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}

{{--            <div class="form-check mb-3">--}}
{{--                <input type="checkbox" name="with_gst" id="with_gst" value="1" class="form-check-input">--}}
{{--                <label for="with_gst" class="form-check-label">Include GST (18%)</label>--}}
{{--            </div>--}}

{{--            <hr>--}}

{{--            --}}{{-- Invoice Items --}}
{{--            <h4>Items</h4>--}}
{{--            <table class="table" id="items_table">--}}
{{--                <thead>--}}
{{--                <tr>--}}
{{--                    <th>Description</th>--}}
{{--                    <th>Qty</th>--}}
{{--                    <th>Unit Price</th>--}}
{{--                    <th>Total</th>--}}
{{--                    <th></th>--}}
{{--                </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}
{{--                <tr>--}}
{{--                    <td><input type="text" name="items[0][description]" class="form-control" required></td>--}}
{{--                    <td><input type="number" name="items[0][qty]" class="form-control qty" min="1" step="1" required></td>--}}
{{--                    <td><input type="number" name="items[0][unit_price]" class="form-control unit_price" min="0" step="0.01" required></td>--}}
{{--                    <td><input type="text" name="items[0][total]" class="form-control total" readonly></td>--}}
{{--                    <td><button type="button" class="btn btn-danger btn-sm remove-row">X</button></td>--}}
{{--                </tr>--}}
{{--                </tbody>--}}
{{--            </table>--}}

{{--            <button type="button" class="btn btn-secondary mb-3" id="add_row">+ Add Item</button>--}}

{{--            <div class="mb-3 text-end">--}}
{{--                <button type="submit" class="btn btn-success">Save Invoice</button>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </div>--}}

{{--    --}}{{-- JS for dynamic rows --}}
{{--    <script>--}}
{{--        let row = 1;--}}
{{--        document.getElementById('add_row').addEventListener('click', function () {--}}
{{--            let table = document.querySelector('#items_table tbody');--}}
{{--            let newRow = `--}}
{{--        <tr>--}}
{{--            <td><input type="text" name="items[${row}][description]" class="form-control" required></td>--}}
{{--            <td><input type="number" name="items[${row}][qty]" class="form-control qty" min="1" step="1" required></td>--}}
{{--            <td><input type="number" name="items[${row}][unit_price]" class="form-control unit_price" min="0" step="0.01" required></td>--}}
{{--            <td><input type="text" name="items[${row}][total]" class="form-control total" readonly></td>--}}
{{--            <td><button type="button" class="btn btn-danger btn-sm remove-row">X</button></td>--}}
{{--        </tr>--}}
{{--    `;--}}
{{--            table.insertAdjacentHTML('beforeend', newRow);--}}
{{--            row++;--}}
{{--        });--}}

{{--        // Remove row--}}
{{--        document.addEventListener('click', function (e) {--}}
{{--            if (e.target.classList.contains('remove-row')) {--}}
{{--                e.target.closest('tr').remove();--}}
{{--            }--}}
{{--        });--}}

{{--        // Auto calculate line total--}}
{{--        document.addEventListener('input', function (e) {--}}
{{--            if (e.target.classList.contains('qty') || e.target.classList.contains('unit_price')) {--}}
{{--                let row = e.target.closest('tr');--}}
{{--                let qty = parseFloat(row.querySelector('.qty').value) || 0;--}}
{{--                let price = parseFloat(row.querySelector('.unit_price').value) || 0;--}}
{{--                row.querySelector('.total').value = (qty * price).toFixed(2);--}}
{{--            }--}}

{{--        });--}}
{{--    </script>--}}
{{--@endsection--}}
