@extends('layouts.app')
@section('page-title','Inventory Transactions')
@section('page-subtitle','Track purchases, issues and adjustments')

@section('content')
    <div class="container mx-auto">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="fw-bold">Inventory Transactions</h2>
            <a href="{{ route('transactions.create') }}" class="btn btn-success">
                + New Transaction
            </a>
        </div>

        <div class="card shadow-sm rounded">
            <div class="card-body p-0">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-light">
                    <tr>
                        <th>Date</th>
                        <th>Item</th>
                        <th>Type</th>
                        <th>Quantity</th>
                        <th>Unit</th>
                        <th>Article</th>
                        <th>User</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($transactions as $t)
                        <tr>
                            <td>{{ $t->created_at->format('Y-m-d') }}</td>
                            <td>
                                {{ class_basename($t->inventoryable_type) }}
                                #{{ $t->inventoryable_id }}
                            </td>
                            <td>
                                <span class="badge bg-{{ $t->type === 'purchase' ? 'primary' : 'secondary' }}">
                                    {{ ucfirst($t->type) }}
                                </span>
                            </td>
                            <td>{{ $t->quantity }}</td>
                            <td>{{ $t->unit }}</td>
                            <td>{{ optional($t->article)->article_number ?? '-' }}</td>
                            <td>{{ optional($t->user)->name ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                No transactions yet.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-3">
            {{ $transactions->links() ?? '' }}
        </div>
    </div>
@endsection
