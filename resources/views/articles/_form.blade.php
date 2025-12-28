
@csrf

<style>
    .form-label {
        font-weight: 600;
        color: #e6e6e6;
    }

    .dark-input, .dark-select, .dark-textarea {
        background: #1f1f1f;
        border: 1px solid #333;
        color: #eee;
        border-radius: 8px;
        padding: 10px;
    }

    .dark-input:focus, .dark-select:focus, .dark-textarea:focus {
        border-color: #5a8dee;
        box-shadow: 0 0 0 0.2rem rgba(90,141,238,.25);
        outline: none;
    }

    .glass-card {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(12px);
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.3);
    }

    .btn-primary-dark {
        background: #5a8dee;
        border: none;
        padding: 10px 18px;
        border-radius: 8px;
        font-weight: 600;
        color: white;
    }

    .btn-primary-dark:hover {
        background: #7aa4ff;
    }

    .btn-cancel {
        color: #8ab4f8;
        font-weight: 500;
    }

    .row-gap {
        row-gap: 20px;
    }
</style>

<div class="row row-gap">

    {{-- Customer --}}
    <div class="col-md-6">
        <label class="form-label">Customer</label>
        <select name="customer_id" class="form-control dark-select">
            <option value="">-- Select Customer --</option>
            @foreach($customers as $c)
                <option value="{{ $c->id }}" {{ $article->customer_id == $c->id ? 'selected' : '' }}>
                    {{ $c->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Status --}}
    <div class="col-md-6">
        <label class="form-label">Status</label>
        <select name="status" class="form-control dark-select">
            <option value="in_progress" {{ $article->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
            <option value="dispatched" {{ $article->status == 'dispatched' ? 'selected' : '' }}>Dispatched</option>
            <option value="cancelled" {{ $article->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
        </select>
    </div>

    {{-- Meta Notes --}}
    <div class="col-md-12">
        <label class="form-label">Meta / Notes</label>
        <textarea name="meta[notes]" class="form-control dark-textarea" rows="5">
{{ $article->meta['notes'] ?? '' }}
        </textarea>
    </div>

</div>

<hr class="border-secondary mt-4">

<div class="d-flex justify-content-between mt-3">
    <a href="{{ route('articles.index') }}" class="btn-cancel">Cancel</a>

    <button type="submit" class="btn-primary-dark">
        {{ $buttonText ?? 'Save' }}
    </button>
</div>
{{--@csrf--}}
{{--<div class="grid grid-cols-1 md:grid-cols-2 gap-4">--}}
{{--    <div>--}}
{{--        <label class="block text-sm font-medium text-gray-700">Customer</label>--}}
{{--        <select name="customer_id" class="mt-1 block w-full border rounded p-2">--}}
{{--            <option value="">-- Select customer --</option>--}}
{{--            @foreach($customers ?? [] as $c)--}}
{{--                <option value="{{ $c->id }}" {{ (old('customer_id',$article->customer_id ?? '') == $c->id) ? 'selected' : '' }}>{{ $c->name }}</option>--}}
{{--            @endforeach--}}
{{--        </select>--}}
{{--    </div>--}}

{{--    <div>--}}
{{--        <label class="block text-sm font-medium text-gray-700">Status</label>--}}
{{--        <select name="status" class="mt-1 block w-full border rounded p-2">--}}
{{--            <option value="in_progress" {{ (old('status',$article->status ?? '')=='in_progress') ? 'selected' : '' }}>In Progress</option>--}}
{{--            <option value="dispatched" {{ (old('status',$article->status ?? '')=='dispatched') ? 'selected' : '' }}>Dispatched</option>--}}
{{--            <option value="cancelled" {{ (old('status',$article->status ?? '')=='cancelled') ? 'selected' : '' }}>Cancelled</option>--}}
{{--        </select>--}}
{{--    </div>--}}

{{--    <div class="md:col-span-2">--}}
{{--        <label class="block text-sm font-medium text-gray-700">Meta / Notes</label>--}}
{{--        <textarea name="meta[notes]" rows="4" class="mt-1 block w-full border rounded p-2">{{ old('meta.notes', $article->meta['notes'] ?? '') }}</textarea>--}}
{{--    </div>--}}
{{--</div>--}}

{{--<div class="mt-4 flex justify-end gap-2">--}}
{{--    <a href="{{ route('articles.index') }}" class="px-4 py-2 bg-gray-100 rounded">Cancel</a>--}}
{{--    <button class="px-4 py-2 bg-indigo-600 text-white rounded">Save</button>--}}
{{--</div>--}}
