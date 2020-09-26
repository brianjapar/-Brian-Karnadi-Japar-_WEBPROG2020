@extends('layouts.app')

@section('title','Show')
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
            @guest
                @foreach ($items as $item)

                <tr>
                    <td><img src="{{ asset('storage/'.$item->foto_barang) }}" alt="{{$item->foto_barang}}" height="250px" width=300px/></td>
                    <td><a href="{{ route('showDataItem',$item->id) }}">{{ $item->nama_barang }}</a></td>
                    <td>{{ $item->kategori_barang }}</td>
                    <td>{{ $item->jumlah_barang }}</td>
                    <td>Rp. {{ $item->harga_barang }}</td>
                </tr>
                @endforeach
            @else
                @foreach ($items as $item)

                <tr>
                    <td><img src="{{ asset('storage/'.$item->foto_barang) }}" alt="{{$item->foto_barang}}" height="250px" width=300px/></td>
                    <td><a href="{{ route('showDataItem',$item->id) }}">{{ $item->nama_barang }}</a></td>
                    <td>{{ $item->kategori_barang }}</td>
                    <td>{{ $item->jumlah_barang }}</td>
                    <td>Rp. {{ $item->harga_barang }}</td>

                    <td>
                        @if (Auth::user()->type == 'admin')
                            <a href="/item/edit/{{$item->id}}" class="btn btn-warning">
                                <svg width="20" height="20" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                  </svg>
                            </a>
                            <a href="/item/delete/{{$item->id}}" class="btn btn-danger">
                                <svg width="20" height="20" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                                  </svg>
                            </a>
                        @endif
                        @if (Auth::user()->type == 'user')
                            <a href={{ route('addCart',$item->id) }} >
                                <svg width="40" height="40" viewBox="0 0 16 16" class="bi bi-cart-plus-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM4 14a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm7 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"/>
                                  </svg>
                            </a>
                        @endif
                    </td>
                </tr>
                @endforeach
            @endguest
        </tbody>
      </table>

      <br>
</div>

{{ $items->links() }};

@endsection
