@extends('layouts.app')
@section('page-title','Start Production Step')

@section('content')
    <form action="{{ route('production_steps.store') ?? route('production.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm">Article</label>
            <input name="article_id" class="mt-1 block w-full border rounded p-2" placeholder="Article ID"/>
        </div>

        <div>
            <label class="block text-sm">Step</label>
            <select name="step" class="mt-1 block w-full border rounded p-2">
                <option>cutting</option>
                <option>stitching</option>
                <option>washing</option>
                <option>packing</option>
                <option>pressing</option>
                <option>qc</option>
                <option>final_packing</option>
                <option>dispatch</option>
            </select>
        </div>

        <div>
            <label class="block text-sm">Meta (JSON)</label>
            <textarea name="meta" class="mt-1 block w-full border rounded p-2" rows="3" placeholder='{"notes":"..."}'></textarea>
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('production_steps.index') }}" class="px-4 py-2 bg-gray-100 rounded">Cancel</a>
            <button class="px-4 py-2 bg-indigo-600 text-white rounded">Start</button>
        </div>
    </form>
@endsection
