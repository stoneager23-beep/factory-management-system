<?php
<table class="table table-hover">
<thead><tr><th>#</th><th>Invoice No</th><th>Article</th><th>customers</th><th>Total</th><th>Status</th></tr></thead>
<tbody>
@foreach($invoices as $inv)
    <tr>
        <td>{{ $inv->id }}</td>
        <td>{{ $inv->invoice_number }}</td>
        <td>{{ $inv->article?->article_number }}</td>
        <td>{{ $inv->customer?->name }}</td>
        <td>{{ $inv->total }}</td>
        <td>{{ ucfirst($inv->status) }}</td>
    </tr>
    @endforeach
    </tbody>
    </table>
