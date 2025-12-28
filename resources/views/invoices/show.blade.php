@extends('layouts.app')
@section('page-title','Invoice Details')
@section('page-subtitle', $invoice->invoice_number)

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="col-span-2 space-y-4">
            <div class="p-4 border rounded">
                <div class="flex justify-between">
                    <div>
                        <h3 class="font-semibold">Invoice #{{ $invoice->invoice_number }}</h3>
                        <p class="text-sm text-gray-500">Article: {{ optional($invoice->article)->article_number }}</p>
                    </div>
                    <div class="text-right">
                        <div class="text-sm text-gray-500">Status</div>
                        <div class="text-lg font-semibold">{{ ucfirst($invoice->status) }}</div>
                    </div>
                </div>
            </div>

            <div class="p-4 border rounded">
                <h4 class="font-semibold">Items</h4>
                <table class="w-full text-sm mt-2">
                    <thead class="text-left text-xs text-gray-500"><tr><th>Description</th><th>Qty</th><th>Unit Price</th><th>Total</th></tr></thead>
                    <tbody>
                    @foreach($invoice->items as $it)
                        <tr class="border-t"><td class="py-2">{{ $it->description }}</td><td>{{ $it->qty }}</td><td>{{ number_format($it->unit_price,2) }}</td><td>{{ number_format($it->total,2) }}</td></tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <aside class="p-4 border rounded">
            <h4 class="font-semibold">Summary</h4>
            <div class="mt-2 text-sm text-gray-700">
                <div class="flex justify-between"><div>Subtotal</div><div>{{ number_format($invoice->subtotal,2) }}</div></div>
                <div class="flex justify-between"><div>GST</div><div>{{ number_format($invoice->gst,2) }}</div></div>
                <div class="flex justify-between font-semibold mt-2"><div>Total</div><div>{{ number_format($invoice->total,2) }}</div></div>
            </div>

            <div class="mt-4 flex flex-col gap-2">
                @if($invoice->status == 'draft')
                    <form action="{{ route('invoices.send_for_approval', $invoice) }}" method="POST">@csrf<button class="px-3 py-2 bg-yellow-500 rounded">Send for approval</button></form>
                @endif
                @if($invoice->status == 'approved')
                    <a href="{{ route('invoices.print', $invoice) }}" class="px-3 py-2 bg-indigo-600 text-white rounded">Print / Download</a>
                @endif
            </div>
        </aside>
    </div>
@endsection
