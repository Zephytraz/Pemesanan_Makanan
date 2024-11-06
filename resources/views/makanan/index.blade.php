@extends('template.index')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-xl-2">
                        @if(auth()->user()->hasRole('admin'))
                            <a href="{{route('makanan.create')}}" class="btn btn-primary mb-3 mb-lg-0"><i class='bx bxs-plus-square'></i> Add makanan</a>
                        @endif
                    </div>
                    <div class="col-lg-9 col-xl-10">
                        <form class="d-flex float-end" role="search" method="get" action="{{route('makanan.index')}}">
                            @csrf
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="input" value="{{request('input')}}">
                            <button class="btn btn-warning" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Display message when there are no books --}}
@if ($data->isEmpty())
    <div class="alert alert-warning text-center">Buku tidak ditemukan.</div>
@endif


<div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5 product-grid">
    <div class="col">
        @foreach ($data as $item)
            <div class="card">
                <img src="{{ asset('storage/uploads/'. $item->photo) }}" class="card-img-top" alt="..."
                    style="width: 100%; height: 300px; object-fit: cover;">
                <div class="card-body">
                    <h6 class="card-title cursor-pointer">Judul: {{$item->judul}}</h6>
                    <div class="d-flex justify-content-between">    
                        <p>Deskripsi: {{Str::limit($item->deskripsi, 10) }}...</p>
                        @if ($item->stock == 0)
                            <p><span class="badge bg-danger">Stok sudah habis</span></p>
                        @else
                        <p><span class="badge bg-success">Stok {{$item->stock}}</span></p>
                        @endif
                    </div>
                    <div class="d-flex align-items-center mt-3 fs-6 justify-content-between">
                        <a href="{{route('makanan.show', $item->id)}}" class="btn btn-secondary">
                            <i class="fa-solid fa-eye"></i> <!-- View icon -->
                        </a>
                        @if (auth()->user()->hasRole('admin'))
                            <a href="{{route('makanan.edit', $item->id)}}" class="btn btn-success">
                                <i class="fa-solid fa-pen-to-square"></i> <!-- Edit icon -->
                            </a>
                            <form action="{{route('makanan.destroy', $item->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus Sample {{$item->judul}}?')">
                                    <i class="fa-solid fa-trash-can"></i> <!-- Delete icon -->
                                </button>
                            </form>
                        @else
                            <form action="{{route('makananfavorit.store')}}" method="post">
                                @csrf
                                <input type="hidden" name="makanan_id" value="{{$item->id}}">
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-thumbs-up"></i> 
                                </button>
                            </form>
                            <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#add_ulasan">
                                <i class="fas fa-pen"></i> 
                            </button>
                            <button class="btn btn-primary" type="button"  data-bs-toggle="modal" data-bs-target="#pembelian">
                                <i class="fas fa-shopping-cart"></i> 
                            </button>
                        @endif
                        {{-- <button type="button" class="btn btn-success">
                            <i class="fa-solid fa-comment"></i> <!-- Add comment icon -->
                        </button>
                        <button type="submit" class="btn btn-light">
                            <i class="fa-solid fa-thumbs-up"></i> <!-- Like icon -->
                        </button>
                        <button type="button" class="btn btn-primary">
                            <i class="fa-solid fa-book"></i> <!-- Borrow icon -->
                        </button> --}}
                    </div>
                </div>
            </div>
            
        @endforeach
    </div>
</div>

@include('makanan.modal')
@endsection
