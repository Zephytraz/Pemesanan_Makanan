@extends('template.index')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4 fw-bold">Detail Makanan: {{ $item->judul }}</h2>
    <div class="row g-4 align-items-center">
        <!-- Image Section -->
        <div class="col-md-5">
            <div class="card border-0 shadow-sm rounded-3">
                <a href="#image-modal" data-bs-toggle="modal">
                    <img src="{{ asset('storage/uploads/' . $item->photo) }}" class="img-fluid rounded-3" alt="Cover Image" style="height: 350px; object-fit: cover;">
                </a>
            </div>
        </div>

        <!-- Details Section -->
        <div class="col-md-7">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body">
                    <h5 class="card-title fw-semibold text-primary mb-4">Informasi Makanan</h5>
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th scope="row" class="text-muted">Judul</th>
                                <td class="fw-semibold">{{ $item->judul }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-muted">Kategori</th>
                                <td>
                                    <span class="badge bg-success px-3 py-2">{{ $item->category->name }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-muted">Deskripsi</th>
                                <td>{{ $item->deskripsi }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-muted">Harga</th>
                                <td class="fw-semibold">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-muted">Stok Makanan</th>
                                <td>{{ $item->stock }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-between mt-4">
                        @if (auth()->user()->hasRole('admin'))
                            <a href="{{ route('makanan.edit', $item->id) }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-pencil-fill me-1"></i> Edit Makanan
                            </a>
                        @endif
                        <a href="{{ route('makanan.index') }}" class="btn btn-secondary btn-sm">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Image Preview -->
<div class="modal fade" id="image-modal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold" id="imageModalLabel">Foto Makanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="{{ asset('storage/uploads/' . $item->photo) }}" class="img-fluid rounded-3 shadow" alt="Cover Image">
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
