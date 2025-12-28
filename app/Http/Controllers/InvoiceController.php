<?php

namespace App\Http\Controllers;
use App\Models\Article;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Customer;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with('customer')->latest()->paginate(20);

        return view('invoices.index', compact('invoices'));
    }
    public function create()
    {
        $lastInvoice = Invoice::orderBy('invoice_number', 'desc')->first();
        $new_number = $lastInvoice ? $lastInvoice->invoice_number + 1 : 1;

        $customers = Customer::all();
        $articles  = Article::all();

        return view('invoices.create', compact(
            'customers',
            'articles',
            'new_number'
        ));
    }
//    public function create()
//    {
//        $lastInvoice = Invoice::orderBy('invoice_number', 'desc')->first();
//        $new_number= $lastInvoice ? $lastInvoice->invoice_number + 1 : 1;
//
//        $customers = Customer::all();
//        return view('invoices.create', compact('customers','new_number'));
//    }

////    public function store(Request $request)
////    {
////        $validated = $request->validate([
////            'invoice_number' => 'required|unique:invoices',
////            'customer_id'    => 'nullable|exists:customers,id',
////            'with_gst'       => 'nullable|boolean',
////            'items'          => 'required|array|min:1',
////            'items.*.description' => 'required|string',
////            'items.*.qty'         => 'required|numeric|min:1',
////            'items.*.unit_price'  => 'required|numeric|min:0',
////        ]);
////
////        // create invoice
////        $invoice = Invoice::create([
////            'invoice_number' => $validated['invoice_number'],
////            'customer_id'    => $validated['customer_id'] ?? null,
////            'with_gst'       => $request->boolean('with_gst'),
////            'status'         => 'draft',
////        ]);
////
////        // calculate totals
////        $subtotal = 0;
////        foreach ($validated['items'] as $item) {
////            $lineTotal = $item['qty'] * $item['unit_price'];
////
////            InvoiceItem::create([
////                'invoice_id'   => $invoice->id,
////                'description'  => $item['description'],
////                'qty'          => $item['qty'],
////                'unit_price'   => $item['unit_price'],
////                'total'        => $lineTotal,
////            ]);
////
////            $subtotal += $lineTotal;
////        }
////
////        $gst = $invoice->with_gst ? $subtotal * 0.18 : 0; // example 18% GST
////        $total = $subtotal + $gst;
////
////        $invoice->update([
////            'subtotal' => $subtotal,
////            'gst'      => $gst,
////            'total'    => $total,
////        ]);
////
////        return redirect()->route('invoices.index')->with('success', 'Invoice created successfully!');
////    }
////    public function store(Request $request)
////    {
//////       dd($request->all());
////        $validated = $request->validate([
////            'invoice_number' => 'required|unique:invoices,invoice_number',
////            'customer_id'    => 'required|exists:customers,id',
////            'with_gst'       => 'boolean',
////           // 'status'         => 'required|in:draft,pending_approval,approved,paid',
////
////            // items validation
////            'items.*.description' => 'required|string',
////            'items.*.qty'         => 'required|numeric|min:0.01',
////            'items.*.unit_price'  => 'required|numeric|min:0',
////        ]);
////
////        // calculate totals
////        $subtotal = 0;
////        foreach ($request->items as $item) {
////            $subtotal += $item['qty'] * $item['unit_price'];
////        }
////        $gst   = $request->with_gst ? $subtotal * 0.16 : 0;
////        $total = $subtotal + $gst;
////
////        // save invoice
////        $invoice = Invoice::create([
////            'invoice_number' => $request->invoice_number,
////            'customer_id'    => $request->customer_id,
////            'subtotal'       => $subtotal,
////            'gst'            => $gst,
////            'total'          => $total,
////            'with_gst'       => $request->with_gst ?? false,
////            'status'         => 'pending_approval',
////        ]);
////
////        // save items
////        foreach ($request->items as $item) {
////            $invoice=InvoiceItem::create([
////                'description' => $item['description'],
////                'qty'         => $item['qty'],
////                'unit_price'  => $item['unit_price'],
////                'total'       => $item['qty'] * $item['unit_price'],
////            ]);
////        }
////
////        return redirect()->route('invoices.index')
////            ->with('success', 'Invoice saved successfully!');
////    }
//    public function store(Request $request)
//    {
//        $validated = $request->validate([
//            'invoice_number' => 'required|unique:invoices,invoice_number',
//            'customer_id'    => 'required|exists:customers,id',
//            'with_gst'       => 'boolean',
//
//            'items.*.article_id' => 'required|exists:articles,id',
//            'items.*.quantity'   => 'required|numeric|min:1',
//            'items.*.unit_price' => 'required|numeric|min:0',
//        ]);
//
//        $subtotal = 0;
//        foreach ($request->items as $item) {
//            $subtotal += $item['quantity'] * $item['unit_price'];
//        }
//
//        $gst   = $request->with_gst ? $subtotal * 0.16 : 0;
//        $total = $subtotal + $gst;
//
//        $invoice = Invoice::create([
//            'invoice_number' => $request->invoice_number,
//            'customer_id'    => $request->customer_id,
//            'subtotal'       => $subtotal,
//            'gst'            => $gst,
//            'total'          => $total,
//            'with_gst'       => $request->with_gst ?? false,
//            'status'         => 'pending_approval',
//        ]);
//
//        foreach ($request->items as $item) {
//            InvoiceItem::create([
//                'invoice_id' => $invoice->id,
//                'article_id' => $item['article_id'],
//                'quantity'   => $item['quantity'],
//                'unit_price' => $item['unit_price'],
//                'total'      => $item['quantity'] * $item['unit_price'],
//            ]);
//        }
//
//        return redirect()->route('invoices.index')
//            ->with('success', 'Invoice saved successfully!');
//    }
//    public function store(Request $request)
//    {
//        $request->validate([
//            'invoice_number'        => 'required|unique:invoices,invoice_number',
//            'customer_id'           => 'required|exists:customers,id',
//            'with_gst'              => 'boolean',
//            'items.*.article_id'    => 'required|exists:articles,id',
//            'items.*.quantity'      => 'required|integer|min:1',
//            'items.*.unit_price'    => 'required|numeric|min:0',
//        ]);
//
//        $subtotal = 0;
//        foreach ($request->items as $item) {
//            $subtotal += $item['quantity'] * $item['unit_price'];
//        }
//
//        $gst = $request->with_gst ? $subtotal * 0.16 : 0;
//        $total = $subtotal + $gst;
//
//        $invoice = Invoice::create([
//            'invoice_number' => $request->invoice_number,
//            'customer_id'    => $request->customer_id,
//            'subtotal'       => $subtotal,
//            'gst'            => $gst,
//            'total'          => $total,
//            'with_gst'       => $request->with_gst ?? false,
//            'status'         => 'pending_approval',
//        ]);
//
//        foreach ($request->items as $item) {
//            InvoiceItem::create([
//                'invoice_id' => $invoice->id,
//                'article_id' => $item['article_id'],
//                'quantity'   => $item['quantity'],
//                'unit_price' => $item['unit_price'],
//                'total'      => $item['quantity'] * $item['unit_price'],
//            ]);
//        }
//
//        return redirect()->route('invoices.index')
//            ->with('success', 'Invoice saved successfully!');
//    }
    public function store(Request $request)
    {
        $request->validate([
            'invoice_number' => 'required|unique:invoices,invoice_number',
            'customer_id'    => 'required|exists:customers,id',
            'with_gst'       => 'nullable|boolean',

            'items' => 'required|array|min:1',
            'items.*.article_id' => 'required|exists:articles,id',
            'items.*.quantity'   => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        /* -----------------------------
           1️⃣ SUBTOTAL FROM NORMAL ITEMS
        ----------------------------- */
        $subtotal = 0;
        foreach ($request->items as $item) {
            $subtotal += $item['quantity'] * $item['unit_price'];
        }

        /* --------------------------------
           2️⃣ B-GRADE / DEFECT DISCOUNT
        -------------------------------- */
        $bGradeDiscount = 0;

        foreach ($request->items as $item) {
            $article = Article::with('productionSteps')->find($item['article_id']);

            foreach ($article->productionSteps as $step) {
                if ($step->defected_qty > 0 && $step->b_grade_price > 0) {
                    $bGradeDiscount += $step->defected_qty * $step->b_grade_price;
                }
            }
        }

        /* -----------------------------
           3️⃣ GST & TOTAL
        ----------------------------- */
        $gst = $request->with_gst ? ($subtotal - $bGradeDiscount) * 0.18 : 0;
        $total = ($subtotal - $bGradeDiscount) + $gst;

        /* -----------------------------
           4️⃣ CREATE INVOICE
        ----------------------------- */
        $invoice = Invoice::create([
            'invoice_number' => $request->invoice_number,
            'customer_id'    => $request->customer_id,
            'subtotal'       => $subtotal,
            'gst'            => $gst,
            'total'          => $total,
            'with_gst'       => $request->with_gst ?? false,
            'status'         => 'pending_approval',
        ]);

        /* -----------------------------
           5️⃣ NORMAL ARTICLE ITEMS
        ----------------------------- */
        foreach ($request->items as $item) {
            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'article_id' => $item['article_id'],
                'quantity'   => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'total'      => $item['quantity'] * $item['unit_price'],
            ]);
        }

        /* -----------------------------
           6️⃣ B-GRADE DISCOUNT LINE
        ----------------------------- */
        if ($bGradeDiscount > 0) {
            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'description'=> 'B-Grade / Defected Items Discount',
                'quantity'   => 1,
                'unit_price' => -$bGradeDiscount,
                'total'      => -$bGradeDiscount,
            ]);
        }

        return redirect()
            ->route('invoices.index')
            ->with('success', 'Invoice created successfully (B-Grade handled)');
    }






    public function show(Invoice $invoice)
    {
        $invoice->load('items', 'customer');
        return view('invoices.show', compact('invoice'));
    }

    public function edit(Invoice $invoice)
    {
        $customers = Customer::all();
        $invoice->load('items');
        return view('invoices.edit', compact('invoice', 'customers'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        $validated = $request->validate([
            'customer_id' => 'nullable|exists:customers,id',
            'status'      => 'required|in:draft,pending_approval,approved,paid',
        ]);

        $invoice->update($validated);

        return redirect()->route('invoices.index')->with('success', 'Invoice updated successfully!');
    }
    public function approve(\App\Models\Invoice $invoice)
    {

        // Update status only if not already approved/paid
        if ($invoice->status === 'draft' || $invoice->status === 'pending_approval') {
            $invoice->update(['status' => 'approved']);
        }

        return redirect()->route('invoices.index')->with('success', 'Invoice approved successfully!');
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return back()->with('success', 'Invoice deleted successfully!');
    }
}
