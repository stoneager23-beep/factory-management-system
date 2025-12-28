<table class="table table-bordered table-dark table-hover mb-0">
    <thead>
    <tr>
        <th>#</th>
        <th>Article #</th>
        <th>Customer</th>
        <th>Total Cost</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>

    @forelse($articles as $article)
        <tr>
            <td>{{ $article->id }}</td>
            <td>{{ $article->article_number }}</td>
            <td>{{ $article->customer->name ?? '—' }}</td>
            <td>Rs {{ number_format($article->total_cost,2) }}</td>

            <td class="d-flex gap-1">

                <!-- VIEW -->
                <a href="{{ route('articles.show',$article) }}"
                   class="btn btn-sm btn-info">
                    View
                </a>

                <!-- PRODUCTION (🔥 FIXED) -->
                <a href="{{ route('production_steps.index',$article) }}"
                   class="btn btn-sm btn-secondary">
                    🏭 Production
                </a>

                <!-- EDIT -->
                <a href="{{ route('articles.edit',$article) }}"
                   class="btn btn-sm btn-warning">
                    Edit
                </a>

                <!-- DELETE -->
                <form action="{{ route('articles.destroy',$article) }}"
                      method="POST"
                      onsubmit="return confirm('Delete article?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">
                        Del
                    </button>
                </form>

            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5" class="text-center text-muted">
                No articles found
            </td>
        </tr>
    @endforelse

    </tbody>
</table>


{{--<table class="table table-bordered">--}}
{{--    <thead class="table-dark">--}}
{{--    <tr>--}}
{{--        <th>#</th>--}}
{{--        <th>Cost</th>--}}
{{--        <th>Article #</th>--}}
{{--        <th>Actions</th>--}}
{{--    </tr>--}}
{{--    </thead>--}}
{{--    <tbody>--}}

{{--    @dd($articles)--}}
{{--    @foreach($articles as $article)--}}
{{--        <tr>--}}
{{--            <td>{{ $article->id }}</td>--}}
{{--            <td>{{ $article->total_cost }}</td>--}}
{{--            <td>{{ $article->article_number }}</td>--}}
{{--            <td>--}}
{{--                <a href="{{ route('articles.edit',$article->id) }}" class="btn btn-sm btn-warning">Edit</a>--}}
{{--                <form action="{{ route('articles.destroy',$article->id) }}" method="POST" class="d-inline">--}}
{{--                    @csrf @method('DELETE')--}}
{{--                    <button type="submit" class="btn btn-sm btn-danger">Del</button>--}}
{{--                </form>--}}
{{--            </td>--}}
{{--        </tr>--}}
{{--    @endforeach--}}
{{--    </tbody>--}}
{{--</table>--}}
