@extends('layouts.app')

@section('content')
    <div class="container py-4 text-white">

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold mb-1">🏭 Production Board</h2>
                <small class="text-muted">
                    Article #{{ $article->article_number }}
                </small>
            </div>

            <a href="{{ route('articles.index') }}"
               class="btn btn-outline-secondary btn-sm">
                ← Back to Article
            </a>
        </div>

        <!-- OVERALL PROGRESS -->
        <div class="card bg-emerald-600 border-secondary mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <strong>Overall Progress</strong>
                    <span class="fw-bold">{{ $progress }}%</span>
                </div>
                <div class="progress" style="height:8px;">
                    <div class="progress-bar bg-success"
                         style="width: {{ $progress }}%">
                    </div>
                </div>
            </div>
        </div>

        <!-- STEPS GRID -->
        <div class="row g-3">

            @forelse($steps as $step)
                <div class="col-lg-4 col-md-6">

                    <div class="card bg-white border-secondary h-100 shadow-sm">

                        <div class="card-body">

                            <!-- STEP HEADER -->
                            <div class="mb-2">
                                <h5 class="fw-bold mb-0">
                                    {{ $step->step_name }}
                                </h5>
                                <small class="text-muted">
                                    Status: {{ ucfirst(str_replace('_',' ',$step->status)) }}
                                </small>
                            </div>

                            <hr class="border-secondary">

                            <form method="POST"
                                  action="{{ route('production_steps.update',$step) }}"
                                  class="production-form">
                            @csrf
                            @method('PATCH')

                            <!-- STATUS -->
                                <div class="mb-2">
                                    <label class="form-label small">Status</label>
                                    <select name="status"
                                            class="form-select form-select-sm bg-white text-black border-secondary">
                                        <option value="pending" @selected($step->status=='pending')>Pending</option>
                                        <option value="in_progress" @selected($step->status=='in_progress')>In Progress</option>
                                        <option value="completed" @selected($step->status=='completed')>Completed</option>
                                    </select>
                                </div>

                                <!-- INPUT / OUTPUT -->
                                <div class="row g-2 mb-2">
                                    <div class="col-6">
                                        <label class="form-label small">Input Qty</label>
                                        <input type="number" min="0"
                                               name="input_qty"
                                               value="{{ $step->input_qty }}"
                                               class="form-control form-control-sm bg-white text-black border-secondary">
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label small">Output Qty</label>
                                        <input type="number" min="0"
                                               name="output_qty"
                                               value="{{ $step->output_qty }}"
                                               class="form-control form-control-sm bg-white text-black border-secondary">
                                    </div>
                                </div>

                                <!-- QUALITY CONTROL -->
                                <div class="row g-2 mb-2">
                                    <div class="col-6">
                                        <label class="form-label small">Checked</label>
                                        <input type="number" min="0"
                                               name="checked_qty"
                                               value="{{ $step->checked_qty }}"
                                               class="form-control form-control-sm bg-white text-black border-secondary qc-checked">
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label small">Defected</label>
                                        <input type="number" min="0"
                                               name="defected_qty"
                                               value="{{ $step->defected_qty }}"
                                               class="form-control form-control-sm bg-white text-black border-secondary qc-defected">
                                    </div>
                                </div>

                                <!-- DEFECT METRICS -->
                                <div class="bg-white rounded p-2 mb-2 small">
                                    <div class="d-flex justify-content-between">
                                        <span>Defect %</span>
                                        <span class="text-danger fw-bold defect-percent">0%</span>
                                    </div>
                                </div>

                                <!-- COST & B-GRADE -->
                                <div class="row g-2 mb-2">
                                    <div class="col-6">
                                        <label class="form-label small">Cost / Unit (Rs)</label>
                                        <input type="number" step="0.01"
                                               name="cost"
                                               value="{{ $step->cost }}"
                                               class="form-control form-control-sm bg-dark text-white border-secondary">
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label small">B-Grade Price</label>
                                        <input type="number" step="0.01"
                                               name="b_grade_price"
                                               value="{{ $step->b_grade_price }}"
                                               class="form-control form-control-sm bg-dark text-white border-secondary">
                                    </div>
                                </div>

                                <!-- REMARKS -->
                                <div class="mb-3">
                                    <label class="form-label small">Remarks</label>
                                    <input type="text"
                                           name="remarks"
                                           value="{{ $step->remarks }}"
                                           placeholder="Defect reason / notes"
                                           class="form-control form-control-sm bg-dark text-white border-secondary">
                                </div>

                                <button class="btn btn-success btn-sm w-100">
                                    💾 Save Update
                                </button>

                            </form>

                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted">
                    No production steps attached to this article.
                </div>
            @endforelse

        </div>
    </div>

    <!-- JS: Live QC Calculation -->
    <script>
        document.querySelectorAll('.production-form').forEach(form => {

            const checked = form.querySelector('.qc-checked');
            const defected = form.querySelector('.qc-defected');
            const percent = form.querySelector('.defect-percent');

            function calculate() {
                const c = parseInt(checked.value) || 0;
                const d = parseInt(defected.value) || 0;

                if (c === 0 || d === 0) {
                    percent.textContent = '0%';
                    return;
                }

                percent.textContent = ((d / c) * 100).toFixed(1) + '%';
            }

            checked.addEventListener('input', calculate);
            defected.addEventListener('input', calculate);

            calculate();
        });
    </script>
@endsection

{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--    <div class="container py-4 text-white">--}}

{{--        <!-- HEADER -->--}}
{{--        <div class="d-flex justify-content-between align-items-center mb-4">--}}
{{--            <div>--}}
{{--                <h2 class="fw-bold mb-1">🏭 Production Board</h2>--}}
{{--                <small class="text-muted">--}}
{{--                    Article #{{ $article->article_number }}--}}
{{--                </small>--}}
{{--            </div>--}}

{{--            <a href="{{ route('articles.index') }}"--}}
{{--               class="btn btn-outline-secondary btn-sm">--}}
{{--                ← Back to Article--}}
{{--            </a>--}}
{{--        </div>--}}

{{--        <!-- PROGRESS -->--}}
{{--        <div class="card bg-dark border-secondary mb-4">--}}
{{--            <div class="card-body">--}}
{{--                <div class="d-flex justify-content-between mb-2">--}}
{{--                    <strong>Overall Progress</strong>--}}
{{--                    <span class="fw-bold">{{ $progress }}%</span>--}}
{{--                </div>--}}
{{--                <div class="progress" style="height:8px;">--}}
{{--                    <div class="progress-bar bg-success"--}}
{{--                         style="width: {{ $progress }}%">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <!-- STEPS -->--}}
{{--        <div class="row g-3">--}}

{{--            @forelse($steps as $step)--}}
{{--                <div class="col-lg-4 col-md-6">--}}
{{--                    <div class="card bg-dark border-secondary h-100 shadow-sm">--}}

{{--                        <div class="card-body">--}}

{{--                            <!-- STEP HEADER -->--}}
{{--                            <div class="mb-2">--}}
{{--                                <h5 class="fw-bold mb-0">--}}
{{--                                    {{ $step->productionStep->name ?? $step->legacy_step_name }}--}}
{{--                                </h5>--}}
{{--                                <small class="text-muted">--}}
{{--                                    Current status: {{ ucfirst(str_replace('_',' ',$step->status)) }}--}}
{{--                                </small>--}}
{{--                            </div>--}}

{{--                            <hr class="border-secondary">--}}

{{--                            <!-- UPDATE FORM -->--}}
{{--                            <form method="POST"--}}
{{--                                  action="{{ route('production_steps.update',$step) }}">--}}
{{--                            @csrf--}}
{{--                            @method('PATCH')--}}

{{--                            <!-- STATUS -->--}}
{{--                                <div class="mb-2">--}}
{{--                                    <label class="form-label small">Status</label>--}}
{{--                                    <select name="status"--}}
{{--                                            class="form-select form-select-sm bg-dark text-white border-secondary">--}}
{{--                                        <option value="pending" @selected($step->status=='pending')>Pending</option>--}}
{{--                                        <option value="in_progress" @selected($step->status=='in_progress')>In Progress</option>--}}
{{--                                        <option value="completed" @selected($step->status=='completed')>Completed</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}

{{--                                <!-- COST -->--}}
{{--                                <div class="mb-3">--}}
{{--                                    <label class="form-label small">Cost (Rs)</label>--}}
{{--                                    <input type="number"--}}
{{--                                           step="0.01"--}}
{{--                                           name="cost"--}}
{{--                                           value="{{ $step->cost }}"--}}
{{--                                           class="form-control form-control-sm bg-dark text-white border-secondary">--}}
{{--                                </div>--}}

{{--                                <button class="btn btn-success btn-sm w-100">--}}
{{--                                    💾 Save Update--}}
{{--                                </button>--}}
{{--                            </form>--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @empty--}}
{{--                <div class="col-12 text-center text-muted">--}}
{{--                    No production steps attached to this article.--}}
{{--                </div>--}}
{{--            @endforelse--}}

{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}
