<?php


namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('customer')->latest()->paginate(20);
        $customers = Customer::all(); // 🔥 REQUIRED BY VIEW

        return view('articles.index', compact('articles', 'customers'));
    }

    public function create()
    {
        $customers = Customer::all(); // 🔥 REQUIRED BY FORM
        return view('articles.create', compact('customers'));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'article_number' => 'required|string|unique:articles,article_number',
            'customer_id' => 'nullable|exists:customers,id',
            'status' => 'nullable|in:pending,in_progress,dispatched,cancelled',
            'total_cost' => 'nullable|numeric',
            'total_price' => 'nullable|numeric',
            'meta' => 'nullable|array',
            'defected_qty' => 'lte:checked_qty',
            'output_qty'   => 'lte:input_qty',

        ]);

        // Create Article
        $article = Article::create($data);

        // 🔥 AUTO ATTACH MASTER STEPS
        $masterSteps = \App\Models\ProductionStep::where('is_active', true)
            ->orderBy('sequence')
            ->get();

        foreach ($masterSteps as $step) {
            \App\Models\ArticleProductionStep::create([
                'article_id' => $article->id,
                'production_step_id' => $step->id,
                'legacy_step_name' => $step->name, // snapshot safety
                'status' => 'pending',
                'cost' => 0,
                'meta' => null,
            ]);
        }

//        return redirect()
//            ->route('articles.show', $article->id)
//            ->with('success', 'Article created with production steps!');

        $articles = Article::with('customer')->latest()->paginate(20);
        $customers = Customer::all(); // 🔥 REQUIRED BY VIEW

        return view('articles.index', compact('articles', 'customers'));

    }

//    public function store(Request $request)
//    {
//        $data = $request->validate([
//            'customer_id' => 'nullable|exists:customers,id',
//            'status' => 'nullable|in:pending,in_progress,dispatched,cancelled',
//            'total_cost' => 'nullable|numeric',
//            'total_price' => 'nullable|numeric',
//            'meta' => 'nullable|array',
//        ]);
//
//        // Auto-generate article number
//        $data['article_number'] = $request['article_number'];
//
//        $article = Article::create($data);
//
//        return redirect()
//            ->route('articles.show', $article)
//            ->with('success', 'Article created successfully!');
//    }

    public function show(Article $article)
    {
        $article->load([
            'customer',
            'productionSteps.productionStep',
            'inventoryTransactions',
            'invoice'
        ]);

        return view('articles.show', compact('article'));
    }


    // ✅ ADDED — THE MISSING EDIT METHOD
    public function edit(Article $article)
    {
        $customers = Customer::all();   // Needed for dropdown
        return view('articles.edit', compact('article', 'customers'));
    }

    public function update(Request $request, Article $article)
    {
        $data = $request->validate([
            'status' => 'nullable|in:pending,in_progress,dispatched,cancelled',
            'total_cost' => 'nullable|numeric',
            'total_price' => 'nullable|numeric',
            'meta' => 'nullable|array',
        ]);

        $article->update($data);

        return back()->with('success', 'Article updated successfully!');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()
            ->route('articles.index')
            ->with('success', 'Article deleted successfully');
    }

    public function search(Request $request)
    {
        $q = $request->input('q');

        $articles = Article::with('customer')
            ->where('article_number', 'like', "%$q%")
            ->orWhereHas('customer', fn($c) => $c->where('name', 'like', "%$q%")
            )
            ->get();

        $customers = Customer::all();

        return view('articles.partials.table', compact('articles', 'customers'));
    }
}

//
//
//namespace App\Http\Controllers;
//
//use App\Models\Article;
//use App\Models\Customer;
//use Illuminate\Http\Request;
//use Illuminate\Support\Str;
//
//class ArticleController extends Controller
//{
//    public function index()
//    {
//        $articles = Article::with('customer')->latest()->paginate(20);
//        $customers = Customer::all(); // 🔥 REQUIRED BY VIEW
//
//        return view('articles.index', compact('articles', 'customers'));
//    }
//
//    public function create()
//    {
//        $customers = Customer::all(); // 🔥 REQUIRED BY FORM
//        return view('articles.create', compact('customers'));
//    }
//
//    public function store(Request $request)
//    {
//
//        $data = $request->validate([
//            'customer_id' => 'nullable|exists:customers,id',
//            'status' => 'nullable|in:pending,in_progress,dispatched,cancelled',
//            'total_cost' => 'nullable|numeric',
//            'total_price' => 'nullable|numeric',
//            'meta' => 'nullable|array',
//        ]);
//
//        // Auto-generate article number
//        $data['article_number'] =$request['article_number'] ;//'ART-' . now()->format('YmdHis') . '-' . Str::upper(Str::random(4));
//
//        $article = Article::create($data);
//
//        return redirect()
//            ->route('articles.show', $article)
//            ->with('success', 'Article created successfully!');
//    }
//
//    public function show(Article $article)
//    {
//
//        $article->load('customer', 'productionSteps', 'inventoryTransactions', 'invoice');
//
//        return view('articles.show', compact('article'));
//    }
//
//    public function update(Request $request, Article $article)
//    {
//        $data = $request->validate([
//            'status' => 'nullable|in:pending,in_progress,dispatched,cancelled',
//            'total_cost' => 'nullable|numeric',
//            'total_price' => 'nullable|numeric',
//            'meta' => 'nullable|array',
//        ]);
//
//        $article->update($data);
//
//        return back()->with('success', 'Article updated successfully!');
//    }
//
//    public function destroy(Article $article)
//    {
//        $article->delete();
//        return redirect()
//            ->route('articles.index')
//            ->with('success', 'Article deleted successfully');
//    }
//
//    public function search(Request $request)
//    {
//        $q = $request->input('q');
//
//        // 🔥 Search by article_number instead of title (title does NOT exist!)
//        $articles = Article::with('customer')
//            ->where('article_number', 'like', "%$q%")
//            ->orWhereHas('customer', fn($c) => $c->where('name', 'like', "%$q%")
//            )
//            ->get();
//
//        $customers = Customer::all(); // Same fix as index()
//
//        return view('articles.partials.table', compact('articles', 'customers'));
//    }
//}
////---------------------------------------------------
////
////namespace App\Http\Controllers;
////
////use App\Models\Article;
////use Illuminate\Http\Request;
////use Illuminate\Support\Str;
////
////class ArticleController extends Controller
////{
////    public function index()
////    {
////        $articles = Article::with('customer')->latest()->paginate(20);
////        return view('articles.index', compact('articles'));
////    }
////
////    public function create()
////    {
////        return view('articles.create');
////    }
////
////    public function store(Request $request)
////    {
////        $data = $request->validate([
////            'customer_id' => 'nullable|exists:customers,id',
////            'meta' => 'nullable|array',
////        ]);
////
////        $data['article_number'] = 'ART-' . now()->format('YmdHis') . '-' . Str::upper(Str::random(4));
////
////        $article = Article::create($data);
////
////        return redirect()->route('articles.show', $article)->with('success', 'Article created');
////    }
////
////    public function show(Article $article)
////    {
////        $article->load('productionSteps', 'inventoryTransactions', 'invoice');
////        return view('articles.show', compact('article'));
////    }
////
////    public function update(Request $request, Article $article)
////    {
////        $data = $request->validate([
////            'status' => 'in:in_progress,dispatched,cancelled',
////            'meta' => 'nullable|array',
////        ]);
////
////        $article->update($data);
////
////        return back()->with('success', 'Article updated');
////    }
////
////    public function destroy(Article $article)
////    {
////        $article->delete();
////        return redirect()->route('articles.index')->with('success', 'Article removed');
////    }
////
////    public function search(Request $request)
////    {
////        $q = $request->input('q');
////        $articles = Article::where('title', 'like', "%$q%")->get();
////        return view('articles.partials.table', compact('articles'));
////    }
////}
