

@extends('layouts.app')

@push('page-styles')
<link rel="stylesheet" href="{{asset('public/invoice/css/style.css')}}">
@endpush

@section('content')


   <div class="page">
        <header>
            <!-- <h1><b contenteditable>INVOICE</b></h1> -->
            <div class="flexbox">
                <div class="logo">
                    <img src="{{asset('public/invoice/logo.png')}}" alt="INVOICE"  >
                    <input type="file" accept="image/*">
                </div>

                <div class="sender">
                    <!-- <h1 contenteditable>Logos </h1> -->
                    <p contenteditable>
                        Jazeerz Co.Ltd. <br>
                        +880-1677691961<br>
                        jazeerz@gmail.com
                    </p>
                </div>
                <div class="sender">
                    <p contenteditable>
                        Katgor,Uttor Patenga <br>
                        CDA road <br>
                       Chittagong 4204
                    </p>
                </div>
            </div>
        </header>
        <div class="flexbox invoice-details">
            <div class="recipient">
                <h3>Bill to</h3>
                <p contenteditable>
                   company name <br>
                    Full Name <br>
                    Street Address <br>
                    City, State, Zip
                </p>
            </div>
            <div>
                <h3>Invoice Number</h3>
                <p contenteditable>0001</p>
                <h3>Date</h3>
                <p contenteditable data-today>09/12/2018</p>
            </div>
            <div>
                <h3>Total invoice</h3>
                <h1><span class="total">600.00</span><span id="prefix" contenteditable>€</span></h1>
            </div>
        </div>

        <hr>

        <table class="inventory">
            <thead>
                <tr>
                    <!-- <th width="5%"><span contenteditable>N°</span></th> -->
                    <th width="45%"><span contenteditable>Description</span></th>
                    <th><span contenteditable>Rate</span></th>
                    <th width="5%"><span contenteditable>Qty.</span></th>
                    <th><span contenteditable>Amount</span></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <!-- <td><span contenteditable>01</span></td> -->
                    <td><a class="cut"> - </a><span contenteditable>First Product</span></td>
                    <td><span data-price contenteditable>280.00</span> <span data-prefix> DA</span> </td>
                    <td><span contenteditable data-qty>4</span></td>
                    <td><span data-price>1120.00</span> <span data-prefix> DA</span> </td>
                </tr>
            </tbody>
        </table>

        <table class="balance">
            <tr>
                <th><span contenteditable>TOTAL HT :</span></th>
                <td><span data-price>600.00</span> <span data-prefix> DA</span> </td>
            </tr>
            <tr>
                <th><span contenteditable>T.V.A</span> <span data-tva contenteditable>(19%)</span></th>
                <td><span data-price>0.00</span> <span data-prefix> DA</span> </td>
            </tr>
            <tr>
                <th><span contenteditable>TOTAL T.T.C</span></th>
                <td><span data-price>600.00</span> <span data-prefix> DA</span> </td>
            </tr>
        </table>

    <div class="footer">
        <h1><span contenteditable>Invoice</span></h1>
        <div style="text-align:center">
            <a href="https://github.com/scyrencop">Github</a> |
            <a href="https://behance.net/scyrencop">Behance</a> |
            <a href="https://twitter.com/scyrencop">Twitter</a> |
            <a href="https://fb.com/dream.h.go">Facebook</a>

            <br>
        </div>
    </div>

   </div>

    {{-- <script src="js/main.min.js"></script> --}}
@endsection
{{-- </html> --}}
