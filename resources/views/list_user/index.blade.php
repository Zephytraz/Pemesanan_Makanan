@extends('template.index')

@section('content')
<h3 class="mb-4">User List</h3>
<div class="card radius-10">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div class="mb-4">		
            </div>
        </div>
        <div class="table-responsive">
            <table class="table align-middle mb-0" id="example">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th class="text-center">Username</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">created account</th>
                        <th class="text-center">Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item):
                        <tr>
                            <td>{{$loop->iteration}} </td>
                            <td class="text-center">
                                {{$item->name}}
                            </td>
                            <td><span class="badge bg-gradient-quepal text-white shadow-sm w-100">{{$item->email}}</span></td>
                            <td class="text-center">{{$item->created_at}}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center">
                                    <form action="{{route('listUser.destroy',$item->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete {{$item->email}}')">Delete</button>
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
@endsection