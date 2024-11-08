@extends('template.index')

@section('content')

<div class="card">
    <div class="card-body p-4">
        <h5 class="card-title">Add Book</h5>
        <hr />
        <div class="form-body mt-4">
            <form method="post" enctype="multipart/form-data" action="{{route('makanan.store')}}">
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <div class="border border-3 p-4 rounded">
                            <div class="mb-3">
                                <label for="inputProductTitle" class="form-label">
                                    <i class="fas fa-book"></i> Judul
                                </label>
                                <input type="text" name="judul" class="form-control" id="inputProductTitle"
                                    placeholder="Enter product judul" value="{{ old('judul') }}">
                            </div>
                            @error('judul')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                            <div class="mb-3">
                                <label for="inputProductDescription" class="form-label">
                                    <i class="fas fa-file-alt"></i> Deskripsi
                                </label>
                                <textarea class="form-control" id="inputProductDescription" rows="3" name="deskripsi">{{ old('deskripsi') }}</textarea>
                            </div>
                            @error('deskripsi')
                                 <div class="text-danger mt-1">{{ $message }}</div>
                             @enderror
                            <div class="mb-3">
                                <label for="image-uploadify" class="form-label">
                                    <i class="fas fa-images"></i> Product Images
                                </label>
                                <input id="image-uploadify" class="form-control" type="file" name="photo" multiple>
                                @if ($errors->has('photo'))
                                    <span class="text-danger">{{ $errors->first('photo') }}</span>
                                @endif
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
                                        name="harga" placeholder="Enter Price" value="{{ old('harga') }}">
                                </div>
                                @error('harga')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                            <div class="col-12">
                                <label for="selectKategori" class="form-label">
                                    <i class="fas fa-tags"></i> Select Category
                                </label>
                                <select name="category_id" id="selectKategori" class="form-control">
                                    <option value="" disabled selected>Select Category</option>
                                    @foreach ($data_category as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                                <div class="col-12">
                                    <label for="inputStock" class="form-label">
                                        <i class="fas fa-box"></i> Stock
                                    </label>
                                    <input type="number" class="form-control" id="inputStock"
                                        placeholder="Enter Stock" name="stock" value="{{ old('stock') }}">
                                </div>
                                @error('stock')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
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