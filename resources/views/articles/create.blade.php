@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2 class="text-white mb-3">➕ Create Article</h2>

        <div class="glass-card">
            <form action="{{ route('articles.store') }}" method="POST">
                @include('articles._form')
            </form>
        </div>
    </div>
@endsection
