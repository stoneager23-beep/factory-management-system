<?php
////
////namespace App\Http\Controllers;
////
////use App\Models\InventoryTransaction;
////use App\Models\Fabric;
////use App\Models\Accessory;
////use Illuminate\Http\Request;
////
////class InventoryTransactionController extends Controller
////{
////    public function index()
////    {
////        $transactions = InventoryTransaction::with('inventoryable','article','user')->latest()->paginate(30);
////        return view('inventory.transactions.index', compact('transactions'));
////    }
////
////    public function purchase(Request $request)
////    {
////        $data = $request->validate([
////            'type' => 'required|in:purchase,adjustment',
////            'inventoryable_type' => 'required|string',
////            'inventoryable_id' => 'required|integer',
////            'quantity' => 'required|numeric',
////            'unit' => 'required|string',
////            'unit_price' => 'nullable|numeric',
////            'payment_method' => 'nullable|in:cash,credit',
////            'article_id' => 'nullable|exists:articles,id',
////        ]);
////
////        $modelClass = $data['inventoryable_type'] === 'fabric' ? Fabric::class : Accessory::class;
////        $inventoryable = $modelClass::findOrFail($data['inventoryable_id']);
////
////        // create transaction
////        $tx = InventoryTransaction::create([
////            'inventoryable_type' => $modelClass,
////            'inventoryable_id' => $inventoryable->id,
////            'type' => $data['type'],
////            'quantity' => $data['quantity'],
////            'unit' => $data['unit'],
////            'unit_price' => $data['unit_price'] ?? 0,
////            'payment_method' => $data['payment_method'] ?? null,
////            'article_id' => $data['article_id'] ?? null,
////            'user_id' => auth()->id(),
////        ]);
////
////        // update stock quantity
////        if ($data['type'] === 'purchase' || $data['type'] === 'adjustment') {
////            $inventoryable->increment('quantity', $data['quantity']);
////        }
////
////        return back()->with('success', 'Inventory purchase recorded');
////    }
////
////    public function issueToArticle(Request $request)
////    {
////        $data = $request->validate([
////            'inventoryable_type' => 'required|string',
////            'inventoryable_id' => 'required|integer',
////            'quantity' => 'required|numeric',
////            'unit' => 'required|string',
////            'article_id' => 'required|exists:articles,id',
////        ]);
////
////        $modelClass = $data['inventoryable_type'] === 'fabric' ? Fabric::class : Accessory::class;
////        $inventoryable = $modelClass::findOrFail($data['inventoryable_id']);
////
////        if ($inventoryable->quantity < $data['quantity']) {
////            return back()->with('error', 'Insufficient stock');
////        }
////
////        $tx = InventoryTransaction::create([
////            'inventoryable_type' => $modelClass,
////            'inventoryable_id' => $inventoryable->id,
////            'type' => 'issue',
////            'quantity' => $data['quantity'],
////            'unit' => $data['unit'],
////            'unit_price' => $inventoryable->unit_price,
////            'article_id' => $data['article_id'],
////            'user_id' => auth()->id(),
////        ]);
////
////        $inventoryable->decrement('quantity', $data['quantity']);
////
////        return back()->with('success', 'Issued to article');
////    }
////    public function search(Request $request) {
////        $q = $request->q;
////        $transactions = InventoryTransaction::whereHas('article', fn($a)=>$a->where('article_number','like',"%$q%"))->get();
////        return view('transactions.partials.table', compact('transactions'));
////    }
////
////}
//second wala ha ye kuttaaaa;
//
//
//namespace App\Http\Controllers;
//
//use App\Models\InventoryTransaction;
//use App\Models\Fabric;
//use App\Models\Accessory;
//use App\Models\Article;
//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
//
//class InventoryTransactionController extends Controller
//{
//    /**
//     * Display a listing of the transactions.
//     */
//    public function index()
//    {
//
//        $transactions = InventoryTransaction::with(['inventoryable', 'article', 'user'])
//            ->latest()
//            ->paginate(30);
//
//        return view('transactions.index', compact('transactions'));
//    }
//
//    /**
//     * Show the form for creating a new transaction.
//     */
//    public function create()
//    {
//        $fabrics = Fabric::all();
//        $accessories = Accessory::all();
//        $articles = Article::all();
//
//        return view('transactions.create', compact('fabrics', 'accessories', 'articles'));
//    }
//
//    /**
//     * Store a new transaction (generic CRUD).
//     */
//    public function store(Request $request)
//    {
//        $validated = $request->validate([
//            'inventoryable_type' => 'required|string|in:fabric,accessory',
//            'inventoryable_id' => 'required|integer',
//            'type' => 'required|in:purchase,issue,adjustment',
//            'quantity' => 'required|numeric|min:0.01',
//            'unit' => 'required|string',
//            'unit_price' => 'nullable|numeric|min:0',
//            'article_id' => 'nullable|exists:articles,id',
//            'payment_method' => 'nullable|in:cash,credit',
//        ]);
//
//        $modelClass = $validated['inventoryable_type'] === 'fabric' ? Fabric::class : Accessory::class;
//        $inventoryable = $modelClass::findOrFail($validated['inventoryable_id']);
//
//        $validated['inventoryable_type'] = $modelClass;
//        $validated['user_id'] = Auth::id();
//
//        InventoryTransaction::create($validated);
//
//        if (in_array($validated['type'], ['purchase', 'adjustment'])) {
//            $inventoryable->increment('quantity', $validated['quantity']);
//        } elseif ($validated['type'] === 'issue') {
//            $inventoryable->decrement('quantity', $validated['quantity']);
//        }
//
//        return redirect()->route('transactions.index')->with('success', 'Transaction recorded successfully.');
//    }
//
//    /**
//     * Custom purchase method (if you still want it).
//     */
//    public function purchase(Request $request)
//    {
//        return $this->store($request); // reuse store()
//    }
//
//    /**
//     * Custom issue to article method.
//     */
//    public function issueToArticle(Request $request)
//    {
//        $data = $request->validate([
//            'inventoryable_type' => 'required|string|in:fabric,accessory',
//            'inventoryable_id' => 'required|integer',
//            'quantity' => 'required|numeric',
//            'unit' => 'required|string',
//            'article_id' => 'required|exists:articles,id',
//        ]);
//
//        $modelClass = $data['inventoryable_type'] === 'fabric' ? Fabric::class : Accessory::class;
//        $inventoryable = $modelClass::findOrFail($data['inventoryable_id']);
//
//        if ($inventoryable->quantity < $data['quantity']) {
//            return back()->with('error', 'Insufficient stock');
//        }
//
//        InventoryTransaction::create([
//            'inventoryable_type' => $modelClass,
//            'inventoryable_id' => $inventoryable->id,
//            'type' => 'issue',
//            'quantity' => $data['quantity'],
//            'unit' => $data['unit'],
//            'unit_price' => $inventoryable->unit_price,
//            'article_id' => $data['article_id'],
//            'user_id' => Auth::id(),
//        ]);
//
//        $inventoryable->decrement('quantity', $data['quantity']);
//
//        return redirect()->route('transactions.index')->with('success', 'Issued to article');
//    }
//
//    /**
//     * Search transactions.
//     */
//    public function search(Request $request)
//    {
//        $q = $request->q;
//        $transactions = InventoryTransaction::whereHas('article', fn($a) => $a->where('article_number', 'like', "%$q%"))->get();
//
//        return view('transactions.partials.table', compact('transactions'));
//    }
//}
//


namespace App\Http\Controllers;

use App\Models\InventoryTransaction;
use App\Models\Fabric;
use App\Models\Accessory;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryTransactionController extends Controller
{
    protected function resolveInventoryableClass(string $type)
    {
        // Accept either 'fabric' / 'accessory' or full class name
        $type = trim($type);
        if (in_array($type, ['fabric', 'Fabric', 'app\models\fabric'], true)) {
            return Fabric::class;
        }
        if (in_array($type, ['accessory', 'Accessory', 'app\models\accessory'], true)) {
            return Accessory::class;
        }
        // If already a namespaced class, use it (basic safety check)
        if (class_exists($type)) {
            return $type;
        }
        // fallback
        throw new \InvalidArgumentException("Unknown inventoryable type: {$type}");
    }

    public function index()
    {
        $transactions = InventoryTransaction::with(['inventoryable', 'article', 'user'])
            ->latest()
            ->paginate(30);

//        return view('transactions.index', compact('transactions'));
        return view('inventory.transactions.index', compact('transactions'));

    }

//    public function create()
//    {
//        $fabrics = Fabric::all();
//        $accessories = Accessory::all();
//        $articles = Article::all();
//
//        return view('transactions.create', compact('fabrics', 'accessories', 'articles'));
//    } Purana function create kaa....!
    public function create()
    {
        return view('inventory.transactions.create');
    }

//    public function store(Request $request)
//    {
//
//        $validated = $request->validate([
//            'inventoryable_type' => 'required|string',
//            'inventoryable_id' => 'required|integer',
//            'type' => 'required|in:purchase,issue,adjustment',
//            'quantity' => 'required|numeric|min:0.01',
//            'unit' => 'nullable|string|max:50',
//            'unit_price' => 'nullable|numeric|min:0',
//            'article_id' => 'nullable|exists:articles,id',
//            'payment_method' => 'nullable|in:cash,credit',
//        ]);
//
//        // resolve class
//        $modelClass = $this->resolveInventoryableClass($validated['inventoryable_type']);
//        $inventoryable = $modelClass::findOrFail($validated['inventoryable_id']);
//
//        // prepare payload
//        $payload = [
//            'inventoryable_type' => $modelClass,
//            'inventoryable_id' => $inventoryable->id,
//            'type' => $validated['type'],
//            'quantity' => $validated['quantity'],
//            'unit' => $validated['unit'] ?? $inventoryable->unit ?? null,
//            'unit_price' => $validated['unit_price'] ?? ($inventoryable->unit_price ?? 0),
//            'article_id' => $validated['article_id'] ?? null,
//            'payment_method' => $validated['payment_method'] ?? null,
//            'user_id' => Auth::id(),
//        ];
//
//        InventoryTransaction::create($payload);
//
//        // update stock
//        if ($payload['type'] === 'purchase' || $payload['type'] === 'adjustment') {
//            $inventoryable->increment('quantity', $payload['quantity']);
//        } elseif ($payload['type'] === 'issue') {
//            $inventoryable->decrement('quantity', $payload['quantity']);
//        }
//
//        return redirect()->route('transactions.index')->with('success', 'Transaction recorded.');
//    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'inventoryable_type' => 'required|string',
            'inventoryable_id'   => 'required|integer',
            'type'               => 'required|in:purchase,issue,adjustment',
            'quantity'           => 'required|numeric|min:0.01',
            'unit'               => 'required|string|max:20',
            'unit_price'         => 'nullable|numeric|min:0',
            'article_id'         => 'nullable|integer|exists:articles,id',
            'payment_method'     => 'nullable|in:cash,credit',
        ]);

//        $transaction = new \App\Models\InventoryTransaction();
//        $transaction->inventoryable_type = $validated['inventoryable_type'];
//        $transaction->inventoryable_id   = $validated['inventoryable_id'];
//        $transaction->type               = $validated['type'];
//        $transaction->quantity           = $validated['quantity'];
//        $transaction->unit               = $validated['unit'];
//        $transaction->unit_price         = $validated['unit_price'] ?? 0;
//        $transaction->article_id         = $validated['article_id'] ?? null;
//        $transaction->payment_method     = $validated['payment_method'] ?? null;
//        $transaction->user_id            = auth()->id(); // store current user
//        $transaction->save();

        $transaction = InventoryTransaction::create([
            'inventoryable_type' => $validated['inventoryable_type'],
            'inventoryable_id'   => $validated['inventoryable_id'],
            'type'               => $validated['type'],
            'quantity'           => $validated['quantity'],
            'unit'               => $validated['unit'],
            'unit_price'         => $validated['unit_price'] ?? 0,
            'article_id'         => $validated['article_id'] ?? null,
            'payment_method'     => $validated['payment_method'] ?? null,
            'user_id'            => auth()->id(),
        ]);


        return redirect()
            ->route('transactions.index')
            ->with('success', 'Transaction recorded successfully.');
    }

    public function edit(InventoryTransaction $transaction)
    {
        $fabrics = Fabric::all();
        $accessories = Accessory::all();
        $articles = Article::all();

        return view('transactions.edit', compact('transaction', 'fabrics', 'accessories', 'articles'));
    }

    public function update(Request $request, InventoryTransaction $transaction)
    {
        $validated = $request->validate([
            'inventoryable_type' => 'required|string',
            'inventoryable_id' => 'required|integer',
            'type' => 'required|in:purchase,issue,adjustment',
            'quantity' => 'required|numeric|min:0.01',
            'unit' => 'nullable|string|max:50',
            'unit_price' => 'nullable|numeric|min:0',
            'article_id' => 'nullable|exists:articles,id',
            'payment_method' => 'nullable|in:cash,credit',
        ]);

        $modelClass = $this->resolveInventoryableClass($validated['inventoryable_type']);
        $inventoryable = $modelClass::findOrFail($validated['inventoryable_id']);

        // if the inventoryable changed or quantity changed, we should adjust stocks carefully.
        // For simplicity here, we'll update the transaction record only (complex stock adjustments
        // require reversing previous transaction amounts - implement if needed).
        $transactionData = [
            'inventoryable_type' => $modelClass,
            'inventoryable_id' => $inventoryable->id,
            'type' => $validated['type'],
            'quantity' => $validated['quantity'],
            'unit' => $validated['unit'] ?? $inventoryable->unit ?? null,
            'unit_price' => $validated['unit_price'] ?? ($inventoryable->unit_price ?? 0),
            'article_id' => $validated['article_id'] ?? null,
            'payment_method' => $validated['payment_method'] ?? null,
        ];

        $transaction->update($transactionData);

        return redirect()->route('transactions.index')->with('success', 'Transaction updated.');
    }

    public function destroy(InventoryTransaction $transaction)
    {
        // Note: deleting a transaction does not reverse stock changes here. Implement if needed.
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaction deleted.');
    }

    // convenience wrappers (optional)
    public function purchase(Request $request)
    {
        return $this->store($request);
    }

    public function issueToArticle(Request $request)
    {
        $data = $request->validate([
            'inventoryable_type' => 'required|string',
            'inventoryable_id' => 'required|integer',
            'quantity' => 'required|numeric|min:0.01',
            'unit' => 'nullable|string|max:50',
            'article_id' => 'required|exists:articles,id',
        ]);

        $modelClass = $this->resolveInventoryableClass($data['inventoryable_type']);
        $inventoryable = $modelClass::findOrFail($data['inventoryable_id']);

        if ($inventoryable->quantity < $data['quantity']) {
            return back()->with('error', 'Insufficient stock.');
        }

        InventoryTransaction::create([
            'inventoryable_type' => $modelClass,
            'inventoryable_id' => $inventoryable->id,
            'type' => 'issue',
            'quantity' => $data['quantity'],
            'unit' => $data['unit'] ?? $inventoryable->unit ?? null,
            'unit_price' => $inventoryable->unit_price ?? 0,
            'article_id' => $data['article_id'],
            'user_id' => Auth::id(),
        ]);

        $inventoryable->decrement('quantity', $data['quantity']);

        return redirect()->route('transactions.index')->with('success', 'Issued to article.');
    }

    public function search(Request $request)
    {
        $q = $request->q;
        $transactions = InventoryTransaction::whereHas('article', fn($a) => $a->where('article_number', 'like', "%$q%"))
            ->with(['inventoryable', 'article', 'user'])
            ->get();

        return view('transactions.partials.table', compact('transactions'));
    }
}

