@extends('layouts.app')

@section('content')
<div class="container">
    <br>
    <h1 class="mb-4" style="color: white;">Purchase History</h1>
    @if($transactions->isEmpty())
        <p style="color: white;">No transactions found.</p>
    @else
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Transaction ID</th>
                    <th>Total (Rp)</th>
                    <th>Date</th>
                    <th>Item Name</th>
                    <th>Address</th>
                    <th>Postal Code</th>
                    <th>Quantity</th>
                    <th>Price (Rp)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                    @foreach($transaction->transactionDetails as $index => $detail)
                        <tr>
                            @if ($index === 0)
                                <td rowspan="{{ count($transaction->transactionDetails) }}">{{ $transaction->id }}</td>
                                <td rowspan="{{ count($transaction->transactionDetails) }}">Rp {{ number_format($transaction->total, 2) }}</td>
                                <td rowspan="{{ count($transaction->transactionDetails) }}">{{ $transaction->created_at->format('Y-m-d H:i') }}</td>
                            @endif
                            <td>{{ $detail->inventory->itemName ?? 'Unknown Item' }}</td>
                            <td>{{ $detail->address }}</td>
                            <td>{{ $detail->postal }}</td>
                            <td>{{ $detail->amount }}</td>
                            <td>Rp {{ number_format($detail->price, 2) }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
