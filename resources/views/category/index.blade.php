@extends('layout.app')

@section('content')
    <main class="container-fluid px-5 mt-5">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">{{ $title }}</h1>
          <a href="/category/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"></i> Tambah Category</a>
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
                        <th width="300px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($category as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>
                            <form action="/category/{{ $item->id }}" method="POST">
                                {{-- Update  --}}
                                <a type="button" href="category/{{ $item->id }}/edit" class="btn btn-warning mt-2"><i class="fa-solid fa-pen-to-square"></i></a>
                                @method("delete")
                                @csrf
                                {{-- Delete  --}}
                                <button type="submit" class="btn btn-danger mt-2">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
      </div>
      </main>
@endsection