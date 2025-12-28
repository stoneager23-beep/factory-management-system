<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>Name</th>
        <th>Type</th>
        <th>Color</th>
        <th>Quantity</th>
        <th>Unit</th>
        <th>Unit Price</th>
        <th>Supplier</th>
        <th>Total Value</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($accessories as $accessory)
        <tr>
            <td>{{ $accessory->name }}</td>
            <td>{{ $accessory->type }}</td>
            <td>{{ $accessory->color ?? '-' }}</td>
            <td>{{ $accessory->quantity }}</td>
            <td>{{ $accessory->unit }}</td>
            <td>{{ $accessory->unit_price ?? '-' }}</td>
            <td>{{ $accessory->supplier ?? '-' }}</td>
            <td>
                @if($accessory->unit_price)
                    {{ $accessory->quantity * $accessory->unit_price }}
                @else
                    -
                @endif
            </td>
            <td>
                <a href="{{ route('accessories.edit', $accessory->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('accessories.destroy', $accessory->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="9" class="text-center">No accessories found.</td>
        </tr>
    @endforelse
    </tbody>
</table>
