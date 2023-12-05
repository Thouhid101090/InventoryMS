

@extends('layouts.app')

@section('content')
    <h1>Sales Details</h1>

    <table>
        <thead>
            <tr>
                <th>Customer</th>
                <th>Product</th>
                <th>quantity</th>
                <th>Price(per product)</th>
                <th>Sub Total</th>
                <th>VAT</th>
                <th>Total</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($sales as $sale)
                @foreach ($products as $p)
                  @foreach ($sale->details as $detail)
                     @foreach ($p->details as $detail)
                        <tr>
                            <td>{{ $sale->customer->name }}</td>
                            <td>{{ $detail->product->product_name }}</td>
                            <td>{{ $detail->quantity }}</td>
                            <td>{{ $detail->unit_price }}</td>
                            <td>{{ $detail->sub_amount }}</td>
                            <td>{{ $detail->tax }}</td>
                            <td>{{ $detail->total_amount }}</td>

                        </tr>
                     @endforeach
                  @endforeach
                @endforeach
            @endforeach
        </tbody>
    </table>
@endsection
