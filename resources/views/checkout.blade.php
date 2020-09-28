@extends('layouts.app')

@section('title','Checkout')
@section('content')



    <div class="artikel">
        @foreach ($orders as $order)

            <h1>Status : {{$order->status}}</h1>
            <h3>Invoice : {{$order->invoice_id}}</h3>
            <p>Alamat : {{$order->alamat}}</p>
            <p>Kode Pos{{$order->kode_pos}}</p>
            <p>Total : Rp. {{$order->total_price}}</p>

        @endforeach
    </div>

@endsection
