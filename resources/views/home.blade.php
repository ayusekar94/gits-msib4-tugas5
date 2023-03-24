@extends('layout.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 mb-3 mt-3">
            <img src="{{ asset('assets/images/logo.png') }}" class="rounded mx-auto d-block" width="150" alt="">
        </div>
        @foreach ($products as $a)
            <div class="col-md-4">
                <div class="card">
                    <img src="{{ asset('assets/images/bunga.jpg')}}" class="card-img-top" alt="...">
                    <div class="card-body">
                    <h5 class="card-title">{{ $a->name }}</h5>
                    <p class="card-text">
                        <strong>Harga : </strong> Rp. {{ number_format($a->price) }} <br>
                        <strong>Stok :</strong> {{ $a->stok }} <br>
                    </p>
                    <a href="/detail/{{ $a->id }}" class="btn btn-primary"><i class="fas fa-shopping-cart"></i> Pesan</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection