@extends('template.index')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-xl-2">
                            @if (auth()->user()->usertype != 'admin')
                                <h5>Page Reviews You</h5>
                            @else
                                <h5>This Page Reviews User</h5>
                            @endif
                        </div>
                        <div class="col-lg-9 col-xl-10">
                            <!-- Form Pencarian (search) jika diperlukan -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5 product-grid">
        @foreach($data_ulasan as $item)
            <div class="col">
                <div class="card">
                    <img src="{{ asset('storage/uploads/'. $item->makanan->photo) }}" class="card-img-top" alt="..." style="width: 100%; height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h6 class="card-title cursor-pointer">Judul: {{ $item->makanan->judul }}</h6>
                        <p>Rating yang diberikan oleh <br> {{ $item->user->email }} :</p>
                        <hr>
                        @for ($i = 1; $i <= $item->rating; $i++)
                            <i class="fas fa-star text-warning"></i>
                        @endfor
                        @for ($i = $item->rating + 1; $i <= 5; $i++)
                            <i class="far fa-star text-warning"></i>
                        @endfor
                        : {{ $item->rating }}
                        <div class="d-flex align-items-center mt-3 fs-6 justify-content-between">
                            <a href="{{ route('ulasan.show', $item->id) }}" class="btn btn-secondary" title="Detail">
                                <i class="fa-solid fa-info-circle"></i>
                            </a>
                            @if (auth()->user()->hasRole('user'))
                                <button type="button" data-bs-toggle="modal" data-bs-target="#edit{{ $item->id }}" class="btn btn-success" title="Edit">
                                    <i class="fa-solid fa-edit"></i>
                                </button>
                                <form action="{{ route('ulasan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ulasan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" title="Hapus">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            @endif          
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Modal Edit -->
    @foreach($data_ulasan as $item)
        <div class="modal fade" id="edit{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit {{ $item->makanan->judul }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('ulasan.update', $item->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="ulasan">Nama Ulasan</label>
                                <input type="text" name="ulasan" class="form-control" value="{{ $item->ulasan }}">
                            </div>
                            <div class="mb-3">
                                <label for="rating">Berikan Rating</label>
                                <select name="rating" id="rating" class="form-control">
                                    <option value="" disabled>Select rating</option>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}" {{ $i == $item->rating ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection
