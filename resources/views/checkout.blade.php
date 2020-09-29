@extends('layouts.app')

@section('title','Checkout')
@section('content')
    <div class="artikel">
        <h2>History Transaction List : </h2>
        <br>
    </div>

    <div class="container-sm" style="background-color: white">

        @foreach ($orders as $order)
            @if(Auth::user()->id == $order->user_id)
            <h1>Status : {{$order->status}}</h1>
            <h3>Invoice : {{$order->invoice_id}}</h3>
            <p>Alamat : {{$order->alamat}}</p>
            <p>Kode Pos{{$order->kode_pos}}</p>
            <p>Total : Rp. {{$order->total_price}}</p>
            @endif
        @endforeach


    </div>

    <div class="artikel">
        <a href="/" class="btn btn-info">Back to Home</a>
    </div>

@endsection
