@extends('layout.app')

@section('content')
    <main class="container-fluid px-5 mt-5">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">{{ $title }}</h1>
          <a href="/product/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"></i> Tambah Product</a>
        </div>
  
        @if ($message = Session::get('success'))
          <div class="alert alert-success">
            <p>{{ $message }}</p>
          </div>
        @endif
  
      <div class="card mb-4">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Deskripsi</th>
                        <th>Stok</th>
                        <th>Price</th>
                        {{-- <th>Image</th> --}}
                        <th width="200px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->category->name }}</td>
                        <td>{{ $item->description }}</td>
                        <td>{{ $item->stok }}</td>
                        <td>{{ $item->price }}</td>
                        {{-- <td>{{ $item->image }}</td> --}}
                        {{-- <td><img width="30px" height="30px" src="{{ asset('storage/' . $item->image) }}" ></td> --}}
                        <td>
                            <a href="/product/{{ $item->id }}/edit">
                                <button class="btn btn-warning mt-2" type="button"><i class="fa-solid fa-pen-to-square"></i></button>
                            </a>
                            <a href="/product/{{ $item->id }}/delete">
                                <button class="btn btn-danger mt-2" type="button"><i class="fa-solid fa-trash-can"></i></button>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
      </div>
      </main>
@endsection