@extends('template.index')

@section('content')
    <div class="container my-5">
        <h2 class="mb-4 text-center">Detail Transaksi</h2>

        @foreach ($data as $detail)
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-primary">
                        <i class="fas fa-receipt"></i> Pemesanan ID: {{ $detail->pemesanan_id }}
                    </h5>
                    <hr>
                    <p class="card-text">
                        <strong>Saldo Anda:</strong> 
                        <span class="text-success">Rp {{ number_format(auth()->user()->saldo, 0, ',', '.') }}</span>
                    </p>
                    <p class="card-text">
                        <strong>Total Pembayaran:</strong> 
                        <span class="text-danger">Rp {{ number_format($detail->total_pembayaran, 0, ',', '.') }}</span>
                    </p>
                    <p class="card-text">
                        <strong>Uang User:</strong> 
                        <span class="text-info">Rp {{ number_format($detail->uang_user, 0, ',', '.') }}</span>
                    </p>
                    <hr>
                    <p class="card-text">
                        <strong>Jumlah Kembalian:</strong> 
                        <span class="text-warning">Rp {{ number_format($detail->jumlah_kembalian, 0, ',', '.') }}</span>
                    </p>
                </div>
            </div>
        @endforeach
    </div>
@endsection
