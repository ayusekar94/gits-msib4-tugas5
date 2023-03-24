@extends('layout.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 mb-3 mt-3">
            <img src="{{ asset('assets/images/logo.png') }}" class="rounded mx-auto d-block" width="150" alt="">
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3><i class="fa fa-shopping-cart"></i> Check Out</h3>
                    @if(!empty($cart))
                    <p align="right">Tanggal Pesan : {{ $cart->tanggal }}</p>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Total Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($cart_details as $cart_detail)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>
                                    <img src="{{ asset('assets/images/bunga.jpg')}}" width="100" alt="...">
                                </td>
                                <td>{{ $cart_detail->product->name }}</td>
                                <td>{{ $cart_detail->jumlah }}</td>
                                <td align="right">Rp. {{ number_format($cart_detail->product->price) }}</td>
                                <td align="right">Rp. {{ number_format($cart_detail->jumlah_harga) }}</td>
                                <td>
                                    <a href="/check-out/{{ $cart_detail->id }}/delete">
                                        <button class="btn btn-danger mt-2" type="button"><i class="fa-solid fa-trash"></i></button>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="5" align="right"><strong>Total Harga :</strong></td>
                                <td align="right"><strong>Rp. {{ number_format($cart->jumlah_harga) }}</strong></td>
                                <td>
                                    <a href="{{ url('konfirmasi-check-out') }}" class="btn btn-success" onclick="return confirm('Anda yakin akan Check Out ?');">
                                        <i class="fa fa-shopping-cart"></i> Check Out
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection