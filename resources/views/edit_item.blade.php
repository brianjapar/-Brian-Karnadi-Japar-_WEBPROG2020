@extends('layouts.app')

@section('title','Edit')
@section('content')

    @if (Session::has('success'))
        <div class="alert alert-success">
            <span>{{Session::get('success')}}</span>
        </div>

    @endif

    @if(!$errors->isEmpty())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    @endif


        <div class="artikel">

            <form class="p-5" action="/item/update/{{$items->id}}" enctype="multipart/form-data" method="POST">
                @method('PATCH')
                @csrf
                <div class="form-group">
                  <label >Kategori Barang</label>
                  <input type="text" class="form-control"  placeholder="ex : Furniture" name="kategori_barang" value="{{old('kategori_barang') ?? $items->kategori_barang}}">

                </div>
                <div class="form-group">
                    <label>Nama Barang</label>
                    <input type="text" class="form-control"  placeholder="ex : Tempat Tidur Modern" name="nama_barang" value="{{old('nama_barang') ?? $items->nama_barang}}">
                </div>

                <div class="form-group">
                    <label>Harga Barang</label>
                    <label >Rp</label>
                    <input type="text" class="form-control"  placeholder="ex : Rp. 2000000" name="harga_barang"  value="{{old('harga_barang') ?? $items->harga_barang}}">
                </div>

                <div class="form-group">
                    <label>Jumlah Barang</label>
                    <input type="text" class="form-control"  placeholder="ex : 2" name="jumlah_barang" value="{{old('jumlah_barang') ?? $items->jumlah_barang}}">
                </div>

                <div class="form-group">
                    <label>Foto Barang</label>
                    <p><input type="file" name="foto_barang">
                        <img class="w-25 h-25" src="{{asset('storage/'.$items->foto_barang)}}" alt="image">
                    </p>

                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
              </form>

        </div>


@endsection
