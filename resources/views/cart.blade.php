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
                  <th >Sub Total</th>
                  <th >Action</th>
                </tr>
              </thead>
            <tbody>
                @php
                    $totalPrice=0;
                    $totalQty =0;
                    $total=0;
                    $subtotal=0;
                @endphp
            @foreach ($cartItems as $order_item)

                <tr>
                    <td>{{ $order_item->item->nama_barang }}</td>
                    <td>{{ $order_item->item->kategori_barang }}</td>
                    <td>
                        {{ $order_item->item->jumlah_barang }}
                    </td>
                    <td >
                        {{ $order_item->item->harga_barang }}
                    </td>
                    @php
                        $totalPrice += $order_item->item->harga_barang;
                        $totalQty += $order_item->item->jumlah_barang;
                        $total += ($order_item->item->jumlah_barang * $order_item->item->harga_barang);
                        $subtotal = $order_item->item->jumlah_barang * $order_item->item->harga_barang;
                    @endphp
                    <td>
                        {{($subtotal)}}
                    </td>
                    <td>
                        <a href="/item/delete/{{$order_item->id}}" class="btn btn-danger">
                            <svg width="20" height="20" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                              </svg>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Total</th>
                    <th></th>
                    <th>{{$totalQty}}</th>
                    <th>Rp. {{$totalPrice}}</th>
                    <th>Rp. {{$total}}</th>
                    <th></th>
                </tr>

            </tfoot>

        </table>
        <br><br>

        <form class="p-5" action="" method="POST" enctype="multipart/form-data">
                @csrf
         <div class="form-group">
            <label>Alamat Pengiriman</label>
            <br>
            <textarea rows='10' cols='60' placeholder="Tulis Alamat Pengiriman disini!" name="alamat_pengiriman"></textarea>
        </div>

        <div class="form-group">
            <label>Kode Pos</label>
            <br>
            <input type="text" placeholder="ex : xxxxx" name="kode_pos">
        </div>

        <a href="" class="btn btn-info">Checkout</a>
    </form>

    </div>


@endsection
