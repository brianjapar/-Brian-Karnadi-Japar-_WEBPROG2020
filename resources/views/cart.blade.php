@extends('layouts.app')

@section('title','Cart')
@section('content')
@if (Session::has('success'))
    <div class="alert alert-success">
        <span>{{Session::get('success')}}</span>
    </div>

    @endif

    @if (Session::has('error'))
    <div class="alert alert-danger">
        <span>{{Session::get('error')}}</span>
    </div>

    @endif

    <div class="artikel">
        @csrf
        <h2>Cart List</h2>
        <table class="table">
            <thead>
                <tr>
                  <th >Nama Barang</th>
                  <th >Kategori Barang</th>
                  <th >Jumlah Barang</th>
                  <th >Harga Barang</th>
                  <th >Action</th>
                </tr>
              </thead>

            @foreach ($cartItems as $order_item)
                <tr>
                    <td>{{ $order_item->item->nama_barang }}</td>
                    <td>{{ $order_item->item->kategori_barang }}</td>
                    <td>{{ $order_item->item->jumlah_barang }}</td>
                    <td>Rp. {{ $order_item->item->harga_barang }}</td>
                    {{-- <a href="/item/delete/{{$order_item->item->id}}" class="btn btn-danger">
                        <svg width="20" height="20" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                          </svg>
                    </a> --}}
                </tr>
            @endforeach
        </table>
    </div>




@endsection
