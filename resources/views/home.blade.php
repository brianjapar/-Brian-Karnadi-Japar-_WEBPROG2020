@extends('layouts.app')

@section('title','CreateItem')
@section('content')
    @if (Session::has('msg'))
    <div class="alert alert-danger">
        {{Session::get('msg')}}
    </div>
    @endif

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
            <form class="p-5" action="/item/create" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label >Kategori Barang</label>
                  <input type="text" class="form-control"  placeholder="ex : Furniture" name="kategori_barang">

                </div>
                <div class="form-group">
                    <label>Nama Barang</label>
                    <input type="text" class="form-control"  placeholder="ex : Tempat Tidur Modern" name="nama_barang">
                </div>

                <div class="form-group">
                    <label>Harga Barang</label>
                    <label >Rp</label>
                    <input type="text" class="form-control"  placeholder="ex : Rp. 2000000" name="harga_barang">
                </div>

                <div class="form-group">
                    <label>Jumlah Barang</label>
                    <input type="text" class="form-control"  placeholder="ex : 2" name="jumlah_barang">
                </div>

                <div class="form-group">
                    <label>Foto Barang</label>

                    <p>
                        <svg width="15" height="15" viewBox="0 0 17 16" class="bi bi-image" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M14.002 2h-12a1 1 0 0 0-1 1v9l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094L15.002 9.5V3a1 1 0 0 0-1-1zm-12-1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm4 4.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                          </svg>
                    <input type="file" name="foto_barang">
                </p>

                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
              <br>
              <br>
        </div>

@endsection

