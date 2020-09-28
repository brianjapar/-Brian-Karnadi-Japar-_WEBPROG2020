@extends('layouts.app')

@section('title','showData')
@section('content')

    <div class="artikel">

        <h1>{{ $items->nama_barang }}</h1>
        <p><sub>dibuat oleh: <span>{{ $items->kategori_barang }}</span></sub></p>
        <img class="w-50 h-50" src="{{ asset('storage/'.$items->foto_barang) }}" alt="{{$items->foto_barang}}" />
        <h3>Rp. {{ $items->harga_barang}}</h3>
    </div>

    <br><br>




    <div class="artikel">
        <h3>Hot Item</h3>
        <br>
        <table class="table">

            <thead>
            <tr>
                @foreach ($new_items as $item)
                <th>{{ $item->nama_barang }}</th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            <tr>
                @foreach ($new_items as $item)
                <td><img src="{{ asset('storage/'.$item->foto_barang) }}" alt="{{$item->foto_barang}}" height="200px" width=300px/></td>
                @endforeach
            </tr>
            </tbody>

        </table>
        <br><br>
    </div>

@endsection
