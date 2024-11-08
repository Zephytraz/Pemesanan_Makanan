@extends('template.index')

@section('content')
<div class="container">
    <h1 class="my-4">Daftar Pemesanan Saya</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($data->isEmpty())
        <div class="alert alert-warning text-center">Anda belum memiliki pemesanan.</div>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Makanan</th>
                    <th>Status Pemesanan</th>
                    <th>Jumlah Pesanan</th>
                    <th>Total Pembayaran</th>
                    <th>Waktu Pemesanan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $index => $pemesanan)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $pemesanan->makanan->judul }}</td>
                        <td>{{ $pemesanan->status_pemesanan }}</td>
                        <td>{{ $pemesanan->jumlah_pesanan }}</td>
                        <td>Rp {{ number_format($pemesanan->total_pembayaran, 0, ',', '.') }}</td>
                        <td>{{ $pemesanan->created_at->format('d M Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
