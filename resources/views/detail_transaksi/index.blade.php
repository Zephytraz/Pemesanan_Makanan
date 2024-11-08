@extends('template.index')

@section('content')
    <div class="container">
        <h2>Detail Transaksi</h2>
        @foreach ($data as $detail)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Pemesanan ID: {{ $detail->pemesanan_id }}</h5>
                    <p class="card-text">Total Pembayaran: {{ $detail->total_pembayaran }}</p>
                    <p class="card-text">Uang User: {{ $detail->uang_user }}</p>
                    <p class="card-text">Jumlah Kembalian: {{ $detail->jumlah_kembalian }}</p>
                </div>
            </div>
        @endforeach
    </div>
@endsection