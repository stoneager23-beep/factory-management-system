@extends('layouts.app')

@section('page-title','Customers')

@section('content')
    <div class="container mx-auto">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Customers</h2>
            <a href="{{ route('customers.create') }}" class="btn btn-primary">+ Add Customer</a>
        </div>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>Name</th><th>Email</th><th>Phone</th><th>Address</th><th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($customers as $c)
                <tr>
                    <td>{{ $c->name }}</td>
                    <td>{{ $c->email ?? '-' }}</td>
                    <td>{{ $c->phone ?? '-' }}</td>
                    <td>{{ $c->address ?? '-' }}</td>
                    <td>
                        <a href="{{ route('customers.edit',$c) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('customers.destroy',$c) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Delete this customer?')" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center text-muted">No customers yet</td></tr>
            @endforelse
            </tbody>
        </table>

        <div class="mt-3">{{ $customers->links() }}</div>
    </div>
@endsection
