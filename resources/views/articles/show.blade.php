@extends('layouts.app')
@section('page-title','Article Details')

@section('content')
    <div class="container py-4 text-white">
{{--//@dd($article)--}}
        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">📄 Article #{{ $article->article_number }}</h2>

            <a href="{{ route('production_steps.index', $article) }}"
               class="btn btn-outline-light">
                🏭 Production Board
            </a>
        </div>

        <div class="row g-4">

            <!-- LEFT -->
            <div class="col-md-8">

                <!-- BASIC INFO -->
                <div class="glass-card mb-4">
                    <h5 class="fw-bold">Basic Information</h5>
                    <hr class="border-secondary">

                    <p><strong>Customer:</strong> {{ $article->customer->name ?? '—' }}</p>

                    <p>
                        <strong>Status:</strong>
                        <span class="badge bg-secondary">
                        {{ ucfirst($article->status) }}
                    </span>
                    </p>

                    <p>
                        <strong>Total Cost:</strong>
                        Rs {{ number_format($article->total_cost,2) }}
                    </p>
                </div>

                <!-- PRODUCTION SUMMARY -->
                <div class="glass-card mb-4">
                    <h5 class="fw-bold">Production Steps</h5>
                    <hr class="border-secondary">

                    @forelse($article->productionSteps as $step)
                        <div class="d-flex justify-content-between align-items-center
                                border-bottom border-secondary py-2">

                            <div>
                                <strong>
                                    {{ $step->productionStep->name ?? $step->legacy_step_name }}
                                </strong>

                                <div class="small text-muted">
                                    Cost: Rs {{ number_format($step->cost,2) }}
                                </div>
                            </div>

                            <span class="badge
                            @if($step->status === 'completed') bg-success
                            @elseif($step->status === 'in_progress') bg-warning text-dark
                            @else bg-secondary
                            @endif">
                            {{ ucfirst(str_replace('_',' ',$step->status)) }}
                        </span>
                        </div>
                    @empty
                        <p class="text-muted mb-0">No production steps attached.</p>
                    @endforelse
                </div>

                <!-- INVENTORY -->
                <div class="glass-card">
                    <h5 class="fw-bold">Inventory Transactions</h5>
                    <hr class="border-secondary">

                    <table class="table table-dark table-sm table-striped mb-0">
                        <thead>
                        <tr>
                            <th>Item</th>
                            <th>Type</th>
                            <th>Qty</th>
                            <th>Unit</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($article->inventoryTransactions as $t)
                            <tr>
                                <td>
                                    {{ class_basename($t->inventoryable_type) }}
                                    #{{ $t->inventoryable_id }}
                                </td>
                                <td>{{ ucfirst($t->type) }}</td>
                                <td>{{ $t->quantity }}</td>
                                <td>{{ $t->unit }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">
                                    No inventory records
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- RIGHT -->
            <div class="col-md-4">
                <div class="glass-card">
                    <h5 class="fw-bold">Invoice</h5>
                    <hr class="border-secondary">

                    @if($article->invoice)
                        <p class="mb-1">
                            <strong>#{{ $article->invoice->invoice_number }}</strong>
                        </p>

                        <p>
                            Total: Rs {{ number_format($article->invoice->total,2) }}
                        </p>

                        <a href="{{ route('invoices.show',$article->invoice) }}"
                           class="btn btn-primary w-100">
                            View Invoice
                        </a>
                    @else
                        <p class="text-muted">No invoice created yet</p>

                        <a href="{{ route('invoices.create',$article) }}"
                           class="btn btn-success w-100">
                            Create Invoice
                        </a>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection

{{--@extends('layouts.app')--}}
{{--@section('page-title','Article Details')--}}

{{--@section('content')--}}
{{--    <div class="container py-4 text-white">--}}

{{--        <div class="d-flex justify-content-between align-items-center mb-4">--}}
{{--            <h2 class="fw-bold">📄 Article #{{ $article->article_number }}</h2>--}}

{{--            <a href="{{ route('production_steps.index', $article->id) }}"--}}
{{--               class="btn btn-outline-light">--}}
{{--                🏭 Production Board--}}
{{--            </a>--}}
{{--        </div>--}}

{{--        <div class="row g-4">--}}

{{--            <!-- LEFT -->--}}
{{--            <div class="col-md-8">--}}

{{--                <!-- BASIC INFO -->--}}
{{--                <div class="glass-card mb-4">--}}
{{--                    <h5 class="fw-bold">Basic Information</h5>--}}
{{--                    <hr class="border-secondary">--}}

{{--                    <p><strong>Customer:</strong> {{ $article->customer->name ?? '—' }}</p>--}}

{{--                    <p>--}}
{{--                        <strong>Status:</strong>--}}
{{--                        <span class="badge bg-secondary">{{ ucfirst($article->status) }}</span>--}}
{{--                    </p>--}}

{{--                    <p><strong>Total Cost:</strong> Rs {{ number_format($article->total_cost,2) }}</p>--}}
{{--                </div>--}}

{{--                <!-- PRODUCTION SUMMARY -->--}}
{{--                <div class="glass-card mb-4">--}}
{{--                    <h5 class="fw-bold">Production Steps</h5>--}}
{{--                    <hr class="border-secondary">--}}

{{--                    @forelse($article->productionSteps as $step)--}}
{{--                        <div class="d-flex justify-content-between border-bottom border-secondary py-2">--}}
{{--                            <div>--}}
{{--                                <strong>{{ ucfirst($step->step) }}</strong>--}}
{{--                                <div class="small text-muted">--}}
{{--                                    Rs {{ number_format($step->cost,2) }}--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <span class="badge--}}
{{--                            @if($step->status=='completed') bg-success--}}
{{--                            @elseif($step->status=='in_progress') bg-warning text-dark--}}
{{--                            @else bg-secondary--}}
{{--                            @endif">--}}
{{--                            {{ ucfirst($step->status) }}--}}
{{--                        </span>--}}
{{--                        </div>--}}
{{--                    @empty--}}
{{--                        <p class="text-muted mb-0">No production steps added yet.</p>--}}
{{--                    @endforelse--}}
{{--                </div>--}}

{{--                <!-- INVENTORY -->--}}
{{--                <div class="glass-card">--}}
{{--                    <h5 class="fw-bold">Inventory Transactions</h5>--}}
{{--                    <hr class="border-secondary">--}}

{{--                    <table class="table table-dark table-sm table-striped mb-0">--}}
{{--                        <thead>--}}
{{--                        <tr>--}}
{{--                            <th>Item</th>--}}
{{--                            <th>Type</th>--}}
{{--                            <th>Qty</th>--}}
{{--                            <th>Unit</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        @forelse($article->inventoryTransactions as $t)--}}
{{--                            <tr>--}}
{{--                                <td>{{ class_basename($t->inventoryable_type) }} #{{ $t->inventoryable_id }}</td>--}}
{{--                                <td>{{ ucfirst($t->type) }}</td>--}}
{{--                                <td>{{ $t->quantity }}</td>--}}
{{--                                <td>{{ $t->unit }}</td>--}}
{{--                            </tr>--}}
{{--                        @empty--}}
{{--                            <tr>--}}
{{--                                <td colspan="4" class="text-center text-muted">No inventory records</td>--}}
{{--                            </tr>--}}
{{--                        @endforelse--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <!-- RIGHT -->--}}
{{--            <div class="col-md-4">--}}
{{--                <div class="glass-card">--}}
{{--                    <h5 class="fw-bold">Invoice</h5>--}}
{{--                    <hr class="border-secondary">--}}

{{--                    @if($article->invoice)--}}
{{--                        <p class="mb-1"><strong>#{{ $article->invoice->invoice_number }}</strong></p>--}}
{{--                        <p>Total: Rs {{ number_format($article->invoice->total,2) }}</p>--}}

{{--                        <a href="{{ route('invoices.show',$article->invoice) }}"--}}
{{--                           class="btn btn-primary w-100">--}}
{{--                            View Invoice--}}
{{--                        </a>--}}
{{--                    @else--}}
{{--                        <p class="text-muted">No invoice created yet</p>--}}

{{--                        <a href="{{ route('invoices.create',$article) }}"--}}
{{--                           class="btn btn-success w-100">--}}
{{--                            Create Invoice--}}
{{--                        </a>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            </div>--}}

{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}
