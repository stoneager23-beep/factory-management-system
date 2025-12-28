<?php


namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleProductionStep;
use Illuminate\Http\Request;

class ProductionStepController extends Controller
{
    // 🏭 Production Board
    public function index(Article $article)
    {
        $steps = $article->productionSteps()
            ->orderBy('id')
            ->get();

        // Overall progress
        $completed = $steps->where('status', 'completed')->count();
        $progress = $steps->count() > 0
            ? round(($completed / $steps->count()) * 100)
            : 0;

        return view('production_steps.index', compact(
            'article',
            'steps',
            'progress'
        ));
    }

    // ✅ Update production step (FULL UPDATE)
    public function update(Request $request, ArticleProductionStep $step)
    {
        $data = $request->validate([

            // Status
            'status' => 'required|in:pending,in_progress,completed',

            // Quantities
            'input_qty' => 'nullable|integer|min:0',
            'output_qty' => 'nullable|integer|min:0',

            // Quality control
            'checked_qty' => 'nullable|integer|min:0',
            'defected_qty' => 'nullable|integer|min:0|lte:checked_qty',

            // Costing
            'cost' => 'nullable|numeric|min:0',
            'b_grade_price' => 'nullable|numeric|min:0',

            // Remarks
            'remarks' => 'nullable|string|max:255',
        ]);

        // 🧠 Smart auto-status logic
        if (
            isset($data['output_qty'], $data['input_qty']) &&
            $data['input_qty'] > 0 &&
            $data['output_qty'] >= $data['input_qty']
        ) {
            $data['status'] = 'completed';
        }

        // 🧠 Safety rules
        if (
            isset($data['checked_qty'], $data['output_qty']) &&
            $data['checked_qty'] > $data['output_qty']
        ) {
            $data['checked_qty'] = $data['output_qty'];
        }

        if (
            isset($data['defected_qty'], $data['checked_qty']) &&
            $data['defected_qty'] > $data['checked_qty']
        ) {
            $data['defected_qty'] = $data['checked_qty'];
        }

        $step->update($data);

        return back()->with('success', 'Production step updated successfully');
    }
}

//
//
//namespace App\Http\Controllers;
//
//use App\Models\Article;
//use App\Models\ArticleProductionStep;
//use Illuminate\Http\Request;
//
//class ProductionStepController extends Controller
//{
//    // 🏭 Production Board
//    public function index(Article $article)
//    {
//        $steps = $article->productionSteps()
//            ->with('productionStep')
//            ->orderBy('production_step_id')
//            ->get();
//
//        $completed = $steps->where('status', 'completed')->count();
//        $progress = $steps->count() > 0
//            ? round(($completed / $steps->count()) * 100)
//            : 0;
//
//        return view('production_steps.index', compact(
//            'article',
//            'steps',
//            'progress'
//        ));
//    }
//
//    // ✅ Update step status / cost
//    public function update(Request $request, ArticleProductionStep $step)
//    {
//        $data = $request->validate([
//            'status' => 'required|in:pending,in_progress,completed',
//            'cost' => 'nullable|numeric|min:0',
//        ]);
//
//        $step->update($data);
//
//        return back()->with('success', 'Production step updated');
//    }
//}

//
//
//namespace App\Http\Controllers;
//
//use App\Models\Article;
//use App\Models\ArticleProductionStep;
//use Illuminate\Http\Request;
//
//class ProductionStepController extends Controller
//{
//    // Show production board for an article
//    public function index(Article $article)
//    {
//        $steps = $article->productionSteps()
//            ->with('productionStep')
//            ->orderBy('production_step_id')
//            ->get();
//
//        $completed = $steps->where('status', 'completed')->count();
//
//        $progress = $steps->count() > 0
//            ? round(($completed / $steps->count()) * 100)
//            : 0;
////dd($article);
//        // ✅ Correct view path
//        return view('production_steps.index', compact('article', 'steps', 'progress'));
//    }
//
//    // Update step (status / cost)
//    public function update(Request $request, ArticleProductionStep $step)
//    {
//        $data = $request->validate([
//            'status' => 'required|in:pending,in_progress,completed',
//            'cost' => 'nullable|numeric',
//        ]);
//
//        $step->update($data);
//
//        return back()->with('success', 'Production step updated');
//    }
//-------------------------------------------------------------------------------------
//}
//
////
////
////namespace App\Http\Controllers;
////
////use App\Models\Article;
////use App\Models\ArticleProductionStep;
////use Illuminate\Http\Request;
////
////class ProductionStepController extends Controller
////{
////    // Show production board for an article
////    public function index(Article $article)
////    {
////        $steps = $article->productionSteps()
////            ->with('productionStep')
////            ->orderBy('production_step_id')
////            ->get();
////
////        $completed = $steps->where('status', 'completed')->count();
////        $progress = $steps->count() > 0
////            ? round(($completed / $steps->count()) * 100)
////            : 0;
////
////        return view('production_steps.index', compact('article', 'steps', 'progress'));
////    }
////
////    // Update step (status / cost)
////    public function update(Request $request, ArticleProductionStep $step)
////    {
////        $data = $request->validate([
////            'status' => 'required|in:pending,in_progress,completed',
////            'cost' => 'nullable|numeric',
////        ]);
////
////        $step->update($data);
////
////        return back()->with('success', 'Production step updated');
////    }
////}
////
//////
//////namespace App\Http\Controllers;
//////
//////use App\Models\Article;
//////use App\Models\ProductionStep;
//////use Illuminate\Http\Request;
//////use App\Events\ArticleDispatched; // event to create later
//////
//////class ProductionStepController extends Controller
//////{
//////    public function store(Request $request, Article $article)
//////    {
//////        $data = $request->validate([
//////            'step' => 'required|string',
//////            'meta' => 'nullable|array',
//////        ]);
//////
//////        $step = $article->productionSteps()->create([
//////            'step' => $data['step'],
//////            'meta' => $data['meta'] ?? null,
//////            'status' => 'in_progress',
//////        ]);
//////
//////        return back()->with('success', 'Production step started');
//////    }
//////
//////    public function complete(Request $request, ProductionStep $productionStep)
//////    {
//////        $data = $request->validate([
//////            'cost' => 'nullable|numeric',
//////            'meta' => 'nullable|array',
//////        ]);
//////
//////        $productionStep->update([
//////            'status' => 'completed',
//////            'cost' => $data['cost'] ?? $productionStep->cost,
//////            'meta' => $data['meta'] ?? $productionStep->meta,
//////        ]);
//////
//////        // update article total cost
//////        $article = $productionStep->article;
//////        $article->total_cost = $article->productionSteps()->sum('cost');
//////        $article->save();
//////
//////        // if this is a dispatch step, mark article as dispatched and fire event
//////        if (strtolower($productionStep->step) === 'dispatch') {
//////            $article->status = 'dispatched';
//////            $article->save();
//////            event(new ArticleDispatched($article));
//////        }
//////
//////        return back()->with('success', 'Step completed');
//////    }
//////    public function search(Request $request) {
//////        $q = $request->q;
//////        $steps = ProductionStep::whereHas('article', fn($a)=>$a->where('article_number','like',"%$q%"))->get();
//////        return view('production.partials.table', compact('steps'));
//////    }
//////
//////}
