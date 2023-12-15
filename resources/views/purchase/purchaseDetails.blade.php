

@extends('layouts.app')

@section('content')
    <h1>Purchase Details</h1>

    <table>
        <thead>
            <tr>
                <th>Supplier</th>
                <th>Product</th>
                <th>quantity</th>
                <th>Price(per product)</th>
                <th>Sub Total</th>
                <th>VAT</th>
                <th>Total</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($purchase as $pur)
            @if ($pur->supplier)
                @foreach ($pur->details ?? [] as $detail)
                    @if ($detail->product)
                        <tr>
                            <td>{{ $pur->supplier->name }}</td>
                            <td>{{ $detail->product->product_name }}</td>
                            <td>{{ $detail->quantity }}</td>
                            <td>{{ $detail->unit_price }}</td>
                            <td>{{ $detail->sub_amount }}</td>
                            <td>{{ $detail->tax }}</td>
                            <td>{{ $detail->total_amount }}</td>
                        </tr>
                    @endif
                @endforeach
            @endif
        @endforeach
        </tbody>
    </table>
@endsection
