@extends('layouts.app')

@section('page-title','Invoices')

@section('content')
    <div class="container">
        <h2 class="mb-3">Invoices</h2>

        <a href="{{ route('invoices.create') }}" class="btn btn-primary mb-3">
            + Add Invoice
        </a>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
            <tr>
                <th>Invoice #</th>
                <th>Customer Name</th>
                <th>Customer Phone</th>
                <th>Status</th>
                <th>Total</th>
                <th style="width: 220px;">Actions</th>
            </tr>
            </thead>

            <tbody>
            @forelse($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->invoice_number }}</td>

                    <td>{{ $invoice->customer->name ?? '-' }}</td>

                    <td>{{ $invoice->customer->phone ?? '-' }}</td>

                    <td>
                    <span class="badge
                        @if($invoice->status === 'approved') bg-success
                        @elseif($invoice->status === 'paid') bg-primary
                        @elseif($invoice->status === 'pending_approval') bg-warning text-dark
                        @else bg-secondary
                        @endif">
                        {{ ucfirst(str_replace('_',' ', $invoice->status)) }}
                    </span>
                    </td>

                    <td>{{ number_format($invoice->total, 2) }}</td>

                    <td>
                        <!-- Edit Button -->
                        <a href="{{ route('invoices.edit', $invoice->id) }}"
                           class="btn btn-sm btn-warning">
                            Edit
                        </a>

                        <!-- Approve Button -->
                        @if(!in_array($invoice->status, ['approved','paid']))
                            <form action="{{ route('invoices.approve', $invoice->id) }}"
                                  method="POST"
                                  style="display:inline-block">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                        class="btn btn-sm btn-success"
                                        onclick="return confirm('Approve this invoice?')">
                                    Approve
                                </button>
                            </form>
                        @else
                            <span class="badge bg-success ms-1">
                            Approved
                        </span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">
                        No invoices found.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="mt-3">
            {{ $invoices->links() }}
        </div>
    </div>
@endsection

{{--@extends('layouts.app')--}}

{{--@section('page-title','Invoices')--}}

{{--@section('content')--}}
{{--    <div class="container">--}}
{{--        <h2>Invoices</h2>--}}
{{--        <a href="{{ route('invoices.create') }}" class="btn btn-primary mb-3">+ Add Invoice</a>--}}



{{--        <table class="table table-striped">--}}
{{--            <thead>--}}
{{--            <tr>--}}
{{--                <th>Invoice #</th>--}}
{{--                <th>Customer Name</th>--}}
{{--                <th>Customer Phone</th>--}}
{{--                <th>Status</th>--}}
{{--                <th>Total</th>--}}
{{--                <th>Actions</th>--}}
{{--            </tr>--}}
{{--            </thead>--}}
{{--            <tbody>--}}
{{--            @foreach($invoices as $invoice)--}}
{{--                <tr>--}}
{{--                    <td>{{ $invoice->invoice_number }}</td>--}}
{{--                    <td>{{ $invoice->customer->name ?? '-' }}</td>--}}
{{--                    <td>{{ $invoice->customer->phone ?? '-' }}</td>--}}
{{--                    <td>{{ ucfirst($invoice->status) }}</td>--}}
{{--                    <td>{{ number_format($invoice->total, 2) }}</td>--}}
{{--                    <td>--}}
{{--                        @if($invoice->status !== 'approved' && $invoice->status !== 'paid')--}}
{{--                            <form action="{{ route('invoices.approve', $invoice->id) }}" method="POST" style="display:inline">--}}
{{--                                @csrf--}}
{{--                                @method('PATCH')--}}
{{--                                <button type="submit" class="btn btn-sm btn-success">--}}
{{--                                    Approve Invoice--}}
{{--                                </button>--}}
{{--                            </form>--}}
{{--                        @else--}}
{{--                            <span class="badge bg-success">Approved</span>--}}
{{--                        @endif--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--            @endforeach--}}
{{--            </tbody>--}}
{{--        </table>--}}


{{--        <div class="mt-3">{{ $invoices->links() }}</div>--}}
{{--    </div>--}}
{{--@endsection--}}
