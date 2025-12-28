<table class="table table-bordered table-striped">
    <thead class="table-dark">
    <tr>
        <th>Name</th>
        <th>Color</th>
        <th>Quantity</th>
        <th>Unit</th>
        <th>Unit Price</th>
        <th>Supplier</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @forelse($fabrics as $fabric)
        <tr>
            <td>{{ $fabric->name }}</td>
            <td>{{ $fabric->color ?? '-' }}</td>
            <td>{{ $fabric->quantity }}</td>
            <td>{{ $fabric->unit }}</td>
            <td>{{ number_format($fabric->unit_price, 2) }}</td>
            <td>{{ $fabric->supplier ?? '-' }}</td>
            <td>
                <a href="{{ route('fabrics.edit', $fabric->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('fabrics.destroy', $fabric->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="7" class="text-center">No fabrics found.</td>
        </tr>
    @endforelse
    </tbody>
</table>
