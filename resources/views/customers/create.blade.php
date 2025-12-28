@extends('layouts.app')
@section('page-title','New customers')

@section('content')
    <div class="max-w-lg mx-auto bg-white p-6 shadow rounded">
        <form action="{{ route('customers.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input name="phone" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Address</label>
                <textarea name="address" class="form-control"></textarea>
            </div>
            <button class="btn btn-success">Save</button>
            <a href="{{ route('customers.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
