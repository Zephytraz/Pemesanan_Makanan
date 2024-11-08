@extends('template.index') <!-- Assuming you have a layout file -->

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <div class="container">
            <h2 class="text-center mb-4">Detail makanan: {{ $item->makanan->judul }}</h2>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <!-- Book Cover Image -->
                    <a href="#image-modal" data-bs-toggle="modal">
                        <img src="{{ asset('storage/uploads/' . $item->makanan->photo) }}" class="img-fluid rounded-3" alt="Cover Image" height="400px">
                    </a>
                </div>
                <!-- Book Details -->
                <div class="col-md-8">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Informasi makanan</h5>
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th scope="row">Pemberi Ulasan</th>
                                        <td>{{ $item->user->email }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">ulasan</th>
                                        <td>{{ $item->ulasan}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Rating</th>
                                        <td>
                                            @for ($i = 1; $i <= $item->rating; $i++)
                                                <i class="fas fa-star text-warning"></i>
                                            @endfor
                                            @for ($i = $item->rating + 1; $i <= 5; $i++)
                                                <i class="far fa-star text-warning"></i>
                                            @endfor
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="float-end">
                                <a href="{{ route('ulasan.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
