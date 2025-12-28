<table class="table table-bordered table-dark table-hover align-middle">
    <thead class="table-secondary text-dark">
    <tr>
        <th>#</th>
        <th>Article</th>
        <th>Step</th>
        <th>Status</th>
        <th>Input</th>
        <th>Output</th>
        <th>Defected</th>
        <th>Cost</th>
        <th>Actions</th>
    </tr>
    </thead>

    <tbody>
    @foreach($steps as $s)
        <tr>
            <td>{{ $s->id }}</td>

            <td>
                <span class="fw-bold">
                    {{ $s->article?->article_number ?? '-' }}
                </span>
            </td>

            <td>
                {{ $s->step_name }}
            </td>

            <td>
                @php
                    $badge = match($s->status) {
                        'pending' => 'secondary',
                        'in_progress' => 'warning',
                        'completed' => 'success',
                        default => 'dark',
                    };
                @endphp

                <span class="badge bg-{{ $badge }}">
                    {{ ucfirst(str_replace('_',' ',$s->status)) }}
                </span>
            </td>

            <td>{{ $s->input_qty }}</td>
            <td>{{ $s->output_qty }}</td>
            <td>
                <span class="text-danger fw-bold">
                    {{ $s->defected_qty }}
                </span>
            </td>

            <td>Rs {{ number_format($s->cost,2) }}</td>

            <td>
                @if($s->status !== 'completed')
                    <form action="{{ route('production.complete',$s) }}"
                          method="POST"
                          class="d-inline">
                        @csrf
                        @method('PATCH')

                        <button class="btn btn-sm btn-success">
                            ✔ Complete
                        </button>
                    </form>
                @else
                    <span class="text-muted small">Done</span>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{--<?php--}}
{{--<table class="table table-bordered">--}}
{{--<thead><tr><th>#</th><th>Article</th><th>Step</th><th>Status</th><th>Cost</th><th>Actions</th></tr></thead>--}}
{{--<tbody>--}}
{{--@foreach($steps as $s)--}}
{{--    <tr>--}}
{{--        <td>{{ $s->id }}</td>--}}
{{--        <td>{{ $s->article?->article_number }}</td>--}}
{{--        <td>{{ $s->step }}</td>--}}
{{--        <td>{{ $s->status }}</td>--}}
{{--        <td>{{ $s->cost }}</td>--}}
{{--        <td>--}}
{{--            @if($s->status != 'completed')--}}
{{--                <form action="{{ route('production.complete',$s->id) }}" method="POST">--}}
{{--                    @csrf--}}
{{--                    <button class="btn btn-sm btn-success">Complete</button>--}}
{{--                </form>--}}
{{--            @endif--}}
{{--        </td>--}}
{{--    </tr>--}}
{{--    @endforeach--}}
{{--    </tbody>--}}
{{--    </table>--}}
