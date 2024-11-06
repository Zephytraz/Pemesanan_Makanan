@extends('template.index')

@section('content')

    <div class="row me-3">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-lg-3 col-xl-2">
                            <h5 class="text-primary mb-0">Favorite makanan</h5>
                        </div>
                        <div class="col-lg-9 col-xl-10">
                            
                        </div>
                    </div>
            </div>
            </div>
        </div>
    </div>

    {{-- Display message if no favorite books are available --}}
    @if ($data->isEmpty())
        <div class="alert alert-warning text-center">No favorite makanan found.</div>
    @else
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5 g-4">
            @foreach ($data as $item)
                <div class="col">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="{{ asset('storage/uploads/' . $item->makanan->photo) }}" class="card-img-top" alt="Book cover" style="height: 300px; object-fit: cover;">
                        <div class="card-body">
                            <h6 class="card-title text-truncate">Title: {{ $item->makanan->judul }}</h6>
                            <p class="card-text text-muted small"> 
                                Description: {{ Str::limit($item->makanan->deskripsi, 10, '...') }}
                            </p>
                            <p class="card-text">
                                @if ($item->makanan->stock == 0)
                                    <span class="badge bg-danger">Out of Stock</span>
                                @else
                                    Stock: {{ $item->makanan->stock }}
                                    <br>
                                    <small class="text-muted">Likes: {{ $likes[$item->makanan->id] ?? 0 }}</small>
                                @endif
                            </p>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center bg-white">
                            <a href="{{route('makanan.show', $item->makanan->id)}}" class="btn btn-outline-secondary btn-sm">
                                <i class="fa-solid fa-eye"></i> View
                            </a>

                            {{-- Only users can remove books from favorites --}}
                            @if(auth()->user()->hasRole('user'))
                                <form action="{{route('makananfavorit.destroy', $item->id)}}" method="post" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                        <i class="fa-solid fa-trash-can"></i> Remove
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

@endsection
