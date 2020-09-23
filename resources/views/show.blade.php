@extends('layouts.app')

@section('title','Show')
@section('content')


<div class="artikel">
    @csrf

    <table class="table">
        <thead>
          <tr>
            <th >Gambar</th>
            <th >Nama Barang</th>
            <th >Kategori Barang</th>
            <th >Jumlah Barang</th>
            <th >Harga Barang</th>
            <th >Action</th>
          </tr>
        </thead>
        <tbody>
                @foreach ($items as $item)

                <tr>
                    <td><img src="{{ asset('storage/'.$item->foto_barang) }}" alt="{{$item->foto_barang}}" height="250px" width=300px/></td>
                    <td><a href="{{ route('showDataItem',$item->id) }}">{{ $item->nama_barang }}</a></td>
                    <td>{{ $item->kategori_barang }}</td>
                    <td>{{ $item->jumlah_barang }}</td>
                    <td>Rp. {{ $item->harga_barang }}</td>
                    <td>
                        <a href="/item/edit/{{$item->id}}" class="btn btn-warning">Edit</a>
                        <a href="/item/delete/{{$item->id}}" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                @endforeach


        </tbody>
      </table>

      <br>
</div>

@endsection
