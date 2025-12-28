@extends('layouts.app')
@section('page-title','Add Accessory')

@section('content')
    <form action="{{ route('accessories.store') }}" method="POST" class="space-y-4">
        @csrf
        <div><label class="block text-sm">Name</label><input name="name" value="{{ old('name') }}" class="mt-1 block w-full border rounded p-2" /></div>

        <div class="grid grid-cols-2 gap-4">
            <div><label class="block text-sm">Type</label><input name="type" value="{{ old('type') }}" class="mt-1 block w-full border rounded p-2" /></div>
            <div><label class="block text-sm">Sub-type</label><input name="subtype" value="{{ old('subtype') }}" class="mt-1 block w-full border rounded p-2" /></div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div><label class="block text-sm">Unit</label><input name="unit" value="{{ old('unit','pcs') }}" class="mt-1 block w-full border rounded p-2" /></div>
            <div><label class="block text-sm">Quantity</label><input name="quantity" value="{{ old('quantity',0) }}" class="mt-1 block w-full border rounded p-2" /></div>
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('accessories.index') }}" class="px-4 py-2 bg-gray-100 rounded">Cancel</a>
            <button class="px-4 py-2 bg-indigo-600 text-white rounded">Save</button>
        </div>
    </form>
@endsection
