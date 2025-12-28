<?php
<table class="table table-striped">
<thead><tr><th>#</th><th>Article</th><th>Type</th><th>Qty</th><th>Unit</th><th>User</th></tr></thead>
<tbody>
@foreach($transactions as $txn)
    <tr>
        <td>{{ $txn->id }}</td>
        <td>{{ $txn->article?->article_number}}</td>
        <td>{{ $txn->type }}</td>
        <td>{{ $txn->quantity }}</td>
        <td>{{ $txn->unit }}</td>
        <td>{{ $txn->user?->name }}</td>
    </tr>
    @endforeach
    </tbody>
    </table>
