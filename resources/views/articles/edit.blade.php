@extends('layouts.app')

@section('content')
    <div class="container py-4">

        <!-- Page Title -->
        <h2 class="text-white mb-4">✏️ Edit Article</h2>

        <!-- Card Wrapper -->
        <div class="glass-card p-4">

            <!-- Update Form -->
            <form action="{{ route('articles.update', $article->id) }}" method="POST">
                @csrf
                @method('PUT')

                @include('articles._form', [
                    'buttonText' => 'Update Article'
                ])
            </form>

        </div>
    </div>
@endsection
