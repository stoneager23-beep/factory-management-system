@extends('layouts.app')
@section('page-title','Edit customers')

@section('content')
    <div class="max-w-lg mx-auto bg-white p-6 shadow rounded">
        <form action="{{ route('customers.update',$customer) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input name="name" value="{{ $customer->name }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ $customer->email }}" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input name="phone" value="{{ $customer->phone }}" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Address</label>
                <textarea name="address" class="form-control">{{ $customer->address }}</textarea>
            </div>
            <button class="btn btn-primary">Update</button>
            <a href="{{ route('customers.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
