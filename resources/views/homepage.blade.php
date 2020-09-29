@extends('layouts.app')

@section('title','HomePage')
@section('content')

    @if (Session::has('msg'))
    <div class="alert alert-danger">
        {{Session::get('msg')}}
    </div>
    @endif

    <div class="artikel">
        @foreach ($items as $item)
            <a href="{{ route('showDataItem',$item->id) }}" class="btn btn-dark">{{$item->kategori_barang}}</a>
        @endforeach

        <br><br>

        <table class="table">

            <thead>
            <tr>
                @foreach ($items as $item)
                <td><img src="{{ asset('storage/'.$item->foto_barang) }}" alt="{{$item->foto_barang}}" height="200px" width=300px/></td>
                @endforeach
            </tr>
            </thead>

        </table>

        <br><br>
        <h1>Welcome to Our Page</h1>
        <br>
        <h4>About<h4>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat possimus corporis ab delectus dicta hic cumque iste, eos reprehenderit laboriosam soluta est, dolor beatae autem culpa ut unde. Commodi, perspiciatis?
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod voluptates similique incidunt magnam praesentium tenetur impedit exercitationem suscipit! Placeat tenetur nesciunt est dignissimos facere repellendus ad quaerat tempora voluptates sequi!
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita autem fugiat corporis? Consectetur, quis amet. Vero laboriosam itaque explicabo, sequi nihil ea nostrum modi quaerat et neque, quae culpa aliquam?
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum itaque officia impedit, cumque, fuga exercitationem quod fugit praesentium delectus consequuntur animi, ipsum in temporibus ratione dolor harum blanditiis corrupti iusto?
            <p>
    </div>



@endsection
