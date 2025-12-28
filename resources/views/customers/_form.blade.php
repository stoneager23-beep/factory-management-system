@extends('layouts.app')

@section('page-title','Customers_Form')
@section('content')
<div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" name="name" value="{{ old('name', $customer->name ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" name="email" value="{{ old('email', $customer->email ?? '') }}">
</div>

<div class="mb-3">
    <label for="phone" class="form-label">Phone</label>
    <input type="text" class="form-control" name="phone" value="{{ old('phone', $customer->phone ?? '') }}">
</div>

<div class="mb-3">
    <label for="address" class="form-label">Address</label>
    <textarea class="form-control" name="address">{{ old('address', $customer->address ?? '') }}</textarea>
</div>
@endsection
