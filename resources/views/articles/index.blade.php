@extends('layouts.app')

@section('content')
    <div class="container py-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-black">📦 Articles</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#articleModal">
                + Add Article
            </button>
        </div>

        <input type="text" id="searchArticle" class="form-control mb-3" placeholder="Search Articles...">

        <div id="articlesTable" class="glass-card">
            @include('articles.partials.table', ['articles' => $articles])
        </div>

    </div>

    <!-- ADD ARTICLE MODAL -->
    <div class="modal fade" id="articleModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content bg-dark text-white">

                <form id="articleForm" method="POST" action="{{ route('articles.store') }}">
                    @csrf

                    <div class="modal-header border-0">
                        <h5 class="modal-title">Add Article</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label>Article Number</label>
                            <input type="text" name="article_number" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Customer</label>
                            <select name="customer_id" class="form-control">
                                <option value="">-- Select --</option>
                                @foreach($customers as $c)
                                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="pending">Pending</option>
                                <option value="in_progress">In Progress</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Total Cost</label>
                            <input type="number" step="0.01" name="total_cost" class="form-control">
                        </div>

                    </div>

                    <div class="modal-footer border-0">
                        <button class="btn btn-success w-100">Save Article</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById("searchArticle").addEventListener("keyup", function () {
            fetch("{{ route('articles.search') }}?q=" + this.value)
                .then(res => res.text())
                .then(html => document.getElementById("articlesTable").innerHTML = html);
        });
    </script>
@endpush
