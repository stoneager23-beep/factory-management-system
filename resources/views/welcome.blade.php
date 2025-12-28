@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">

        {{-- Page Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-primary mb-0">🏭 Dashboard</h2>
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                <i class="fa fa-home me-2"></i> Home
            </a>
        </div>

        {{-- Stats Cards --}}
        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center">
                        <div class="text-primary mb-2"><i class="fa fa-box fa-2x"></i></div>
                        <h5 class="fw-bold">{{ $stats['articles'] ?? 0 }}</h5>
                        <p class="text-muted mb-0">Articles</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center">
                        <div class="text-success mb-2"><i class="fa fa-ruler-combined fa-2x"></i></div>
                        <h5 class="fw-bold">{{ $stats['fabrics'] ?? 0 }}</h5>
                        <p class="text-muted mb-0">Fabrics in Stock</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center">
                        <div class="text-warning mb-2"><i class="fa fa-file-invoice fa-2x"></i></div>
                        <h5 class="fw-bold">{{ $stats['invoices'] ?? 0 }}</h5>
                        <p class="text-muted mb-0">Invoices</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center">
                        <div class="text-danger mb-2"><i class="fa fa-industry fa-2x"></i></div>
                        <h5 class="fw-bold">{{ $stats['production_pending'] ?? 0 }}</h5>
                        <p class="text-muted mb-0">Pending Production</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Main Section: Recent Invoices + Notifications --}}
        <div class="row g-4">
            {{-- Recent Invoices --}}
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-light fw-bold">
                        Recent Invoices
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                <tr>
                                    <th>Invoice #</th>
                                    <th>Customer</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($recentInvoices ?? [] as $inv)
                                    <tr>
                                        <td><a href="{{ route('invoices.show',$inv->id) }}" class="fw-semibold">{{ $inv->invoice_number }}</a></td>
                                        <td>
                                            {{ optional($inv->customer)->name ?? '-' }}<br>
                                            <small class="text-muted">{{ optional($inv->customer)->phone ?? '' }}</small>
                                        </td>
                                        <td>{{ number_format($inv->total ?? 0,2) }}</td>
                                        <td>
                                            @if($inv->status == 'approved')
                                                <span class="badge bg-success">Approved</span>

                                            @elseif($inv->status == 'pending_approval')
                                                <span class="badge bg-warning text-dark">Pending</span>
                                            @else
                                                <span class="badge bg-secondary">Draft</span>
                                            @endif
                                        </td>
                                        <td>{{ $inv->created_at->format('Y-m-d') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted">No recent invoices</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <a href="{{ route('invoices.index') }}" class="btn btn-sm btn-outline-primary">
                            View All Invoices
                        </a>
                    </div>
                </div>
            </div>

            {{-- Notifications --}}
            <div class="col-lg-4">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-light fw-bold">
                        Notifications
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><small class="text-muted">No critical alerts</small></li>
                            <li class="mb-2">🟢 All systems operational</li>
                            <li class="mb-2">📦 Inventory up-to-date</li>
                            <li class="mb-2">⚙️ Production running smoothly</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <div class="text-muted small text-center mt-5">
            © {{ date('Y') }} Factory Management System — All rights reserved.
        </div>

    </div>
@endsection
