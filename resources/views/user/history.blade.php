@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Purchase History</h1>

    @if($transactions->isEmpty())
        <p>No transactions found.</p>
    @else
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Transaction ID</th>
                    <th>Total ($)</th>
                    <th>Date</th>
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Price ($)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                    @foreach($transaction->transactionDetails as $index => $detail)
                        <tr>
                            @if ($index === 0)
                                <td rowspan="{{ count($transaction->transactionDetails) }}">{{ $transaction->id }}</td>
                                <td rowspan="{{ count($transaction->transactionDetails) }}">{{ number_format($transaction->total, 2) }}</td>
                                <td rowspan="{{ count($transaction->transactionDetails) }}">{{ $transaction->created_at->format('Y-m-d H:i') }}</td>
                            @endif
                            <td>{{ $detail->inventory->itemName ?? 'Unknown Item' }}</td>
                            <td>{{ $detail->amount }}</td>
                            <td>${{ number_format($detail->price, 2) }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
