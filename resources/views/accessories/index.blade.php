@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between mb-3">
            <h2>Accessories</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#accessoryModal">
                + Add Accessory
            </button>
        </div>

        <input type="text" id="searchAccessory" class="form-control mb-3" placeholder="Search Accessories...">
        <div id="accessoriesTable">
            @include('accessories.partials.table', ['accessories' => $accessories])
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="accessoryModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="accessoryForm" method="POST" action="{{ route('accessories.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add Accessory</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Type</label>
                            <input type="text" name="type" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Color</label>
                            <input type="text" name="color" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Quantity</label>
                            <input type="number" step="0.01" name="quantity" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Unit</label>
                            <input type="text" name="unit" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Unit Price</label>
                            <input type="number" step="0.01" name="unit_price" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Supplier</label>
                            <input type="text" name="supplier" class="form-control">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById("searchAccessory").addEventListener("keyup", function() {
            fetch("{{ route('accessories.search') }}?q=" + this.value)
                .then(res => res.text())
                .then(data => document.getElementById("accessoriesTable").innerHTML = data);
        });
    </script>
@endpush
