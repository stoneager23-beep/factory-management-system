@extends('layouts.app')
@section('content')
    <div class="container">
        <h2>Fabrics</h2>
        <a href="{{ route('fabrics.create') }}" class="btn btn-primary mb-3">+ Add Fabric</a>

        <input type="text" id="searchFabric" class="form-control mb-3" placeholder="Search by Name or Color...">

        <div id="fabricTable">
            @include('fabrics.partials.table', ['fabrics' => $fabrics])
        </div>
    </div>


    @push('scripts')
        <script>
            document.getElementById("searchFabric").addEventListener("keyup", function() {
                fetch("{{ route('fabrics.search') }}?q=" + this.value)
                    .then(res => res.text())
                    .then(data => document.getElementById("fabricTable").innerHTML = data);
            });
        </script>
    @endpush
@endsection
