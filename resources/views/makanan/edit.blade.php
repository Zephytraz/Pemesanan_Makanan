@extends('template.index')

@section('content')

<div class="card">
    <div class="card-body p-4">
        <h5 class="card-title">Add Book</h5>
        <hr />
        <div class="form-body mt-4">
            <form method="post" enctype="multipart/form-data" action="{{route('makanan.update', $item->id)}}">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-8">
                        <div class="border border-3 p-4 rounded">
                            <div class="mb-3">
                                <label for="inputProductTitle" class="form-label">
                                    <i class="fas fa-book"></i> Judul
                                </label>
                                <input type="text" name="judul" class="form-control" id="inputProductTitle"
                                    placeholder="Enter product judul" value="{{ $item->judul }}">
                            </div>
                            <div class="mb-3">
                                <label for="inputProductDescription" class="form-label">
                                    <i class="fas fa-file-alt"></i> Deskripsi
                                </label>
                                <textarea class="form-control" id="inputProductDescription" rows="3" name="deskripsi">{{ $item->deskripsi }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="image-uploadify" class="form-label">
                                    <i class="fas fa-images"></i> 
                                </label>
                                <input id="image-uploadify" class="form-control" type="file" name="photo" multiple>
                                @if ($errors->has('photo'))
                                    <span class="text-danger">{{ $errors->first('photo') }}</span>
                                @endif
                                <a href="{{ asset('storage/uploads/' . $item->photo) }}" class="mt-2">
                                    <img src="{{ asset('storage/uploads/' . $item->photo) }}" class="rounded-3" alt="Cover Image" height="100px">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="border border-3 p-4 rounded">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="inputCostPerPrice" class="form-label">
                                        <i class="fas fa-calendar-alt"></i> Harga
                                    </label>
                                    <input type="number" class="form-control" id="inputCostPerPrice"
                                        name="harga" placeholder="Enter Price" value="{{ $item->harga }}">
                                </div>
                                <div class="col-12">
                                    <label for="selectKategori" class="form-label">
                                        <i class="fas fa-tags"></i> Select Category
                                    </label>
                                    <select name="category_id" id="selectKategori" class="form-control">
                                        <option value="" disabled selected>Select Category</option>
                                        @foreach ($data_category as $category)
                                        <option value="{{ $category->id }}" {{  $item->category_id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="inputStock" class="form-label">
                                        <i class="fas fa-box"></i> Stock
                                    </label>
                                    <input type="number" class="form-control" id="inputStock"
                                        placeholder="Enter Stock" name="stock" value="{{ $item->stock }}">
                                </div>
                                <div class="col-12">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary" >
                                            <i class="fas fa-save"></i> Save Book
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection