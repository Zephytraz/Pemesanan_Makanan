@extends('template.index')

@section('content')
<h1>Halaman Category</h1>
<div class="card radius-10">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div>
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fa-solid fa-calendar-plus"></i>
                </button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table align-middle mb-0" id="example">
                <thead class="table-light text-center">
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Jenis Buku</th>
                        <th class="text-center">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td class="text-center">{{$loop->iteration}}</td> <!-- Tambahkan text-center di sini -->
                            <td     class="text-center" width="70%"><span class="badge bg-gradient-quepal text-white shadow-sm w-50">{{$item->name}}</span>
                            </td> <!-- Tambahkan text-center di sini -->
                            <td class="text-center">
                                <div class="d-flex justify-content-center">
                                    <button type="button" class="btn btn-success mb-2 me-2" data-bs-toggle="modal"
                                        data-bs-target="#edit{{$item->id}}"><i class="fa-solid fa-pen-to-square"></i></button>
                                    <form  action="{{route('category.destroy',$item->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit" onclick="return confirm('apakah anda yakin ingin menghapus {{$item->name}}')" name="archive"><i class="fa-solid fa-trash-can-arrow-up"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('category.modal')
@endsection