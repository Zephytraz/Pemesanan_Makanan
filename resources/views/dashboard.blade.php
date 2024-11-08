@extends('template.index')

@section('content')

    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-5">
        @if(auth()->user()->hasRole('admin'))
        <div class="col">
            <div class="card radius-10 overflow-hidden">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <a href="?p=kategori">
                                <p class="mb-0 text-secondary font-14">Total Category</p>
                            </a>
                            <h5 class="my-0"> {{ $total_category }} </h5>
                        </div>
                        <div class="text-primary ms-auto font-30"><i class='bx bx-category'></i></div>
                    </div>
                </div>
                <div class="mt-1" id="chart1"></div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 overflow-hidden">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <a href="?p=buku">
                                <p class="mb-0 text-secondary font-14">Total Books</p>
                            </a>
                            <h5 class="my-0">{{ $total_makanan }} </h5>
                        </div>
                        <div class="text-danger ms-auto font-30"><i class='fa fa-book'></i></div>
                    </div>
                </div>
                <div class="mt-1" id="chart2"></div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 overflow-hidden">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <a href="?p=list_user">
                                <p class="mb-0 text-secondary font-14">Users</p>
                            </a>
                            <h5 class="my-0"> {{$total_user}} </h5>
                        </div>
                        <div class="text-success ms-auto font-30"><i class='bx bx-group'></i></div>
                    </div>
                </div>
                <div class="mt-1" id="chart3"></div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 overflow-hidden">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary font-14">Ulasan</p>
                            <h5 class="my-0">{{$total_ulasan}} </h5>
                        </div>
                        <div class="text-warning ms-auto font-30"><i class='bx bx-comment'></i></div>
                    </div>
                </div>
                <div class="mt-1" id="chart4"></div>
            </div>
        </div>
        @else
            <div class="col">
                <div class="card radius-10 overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <a href="?p=buku">
                                    <p class="mb-0 text-secondary font-14">Total makanan</p>
                                </a>
                                <h5 class="my-0">{{ $total_makanan }} </h5>
                            </div>
                            <div class="text-danger ms-auto font-30"><i class='fa fa-book'></i></div>
                        </div>
                    </div>
                    <div class="mt-1" id="chart2"></div>
                </div>
            </div>   
            <div class="col">
                <div class="card radius-10 overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary font-14">Ulasan</p>
                                <h5 class="my-0">{{$total_ulasan}} </h5>
                            </div>
                            <div class="text-warning ms-auto font-30"><i class='bx bx-comment'></i></div>
                        </div>
                    </div>
                    <div class="mt-1" id="chart4"></div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary font-14">pemesanan</p>
                                <h5 class="my-0">{{$data_pemesanan}} </h5>
                            </div>
                            <div class="text-info ms-auto font-30"><i class='bx bx-file'></i></div>
                        </div>
                    </div>
                    <div class="mt-1" id="chart5"></div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-warning">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary"><a href="?p=peminjaman">detail transaksi</a></p>
                                <h4 class="my-1 text-warning"> {{$detail_transaksi}} </h4>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto">
                                <i class='bx bx-book-open'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @endif
      
    </div>


    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-2">Product book</h6>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>title Porduct</th>
                                    <th>Photo</th>
                                    <th class="text-center">autor</th>
                                    <th class="text-center">date publication</th>
                                    <th class="text-center">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                    {{-- <tr>
                                        <td>{{ $item->title}}</td>
                                        <td>
                                            <a href="{{ asset('storage/uploads/' . $item->photo) }}">
                                                <img src="{{ asset('storage/uploads/' . $item->photo ) }}" class="rounded-3" alt="Cover Image" height="50px">
                                            </a>
                                        </td>
                                        <td><span class="badge bg-gradient-quepal text-white shadow-sm w-100">{{ $item->autor }}</span></td>
                                        <td class="text-center">{{ $item->date_publication }}</td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center">
                                                <a href="?p=detail_buku&id_buku={{ $item['id_buku'] }}" class="btn btn-secondary me-1">Detail</a>
                                            </div>
                                        </td>
                                    </tr> --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-2">Ulasan</h6>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Judul Product</th>
                                    <th>Photo</th>
                                    <th class="text-center">Penulis</th>
                                    <th class="text-center">Tahun Terbit</th>
                                    <th class="text-center">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($data_ulasan as $item)
                                    <tr>
                                        <td>{{ $item['judul'] }}</td>
                                        <td>
                                            <a href="{{ asset('app/uploads/' . $item['foto']) }}">
                                                <img src="{{ asset('app/uploads/' . $item['foto']) }}" class="rounded-3" alt="Cover Image" height="50px">
                                            </a>
                                        </td>
                                        <td><span class="badge bg-gradient-quepal text-white shadow-sm w-100">{{ $item['penulis'] }}</span></td>
                                        <td class="text-center">{{ $item['tahun_terbit'] }}</td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center">
                                                <a href="?p=detail_ulasan&id_ulasan={{ $item['id_ulasan'] }}" class="btn btn-secondary me-1">Detail</a>
                                                <a href="?p=ulasan" class="btn btn-success ms-1">Edit</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection