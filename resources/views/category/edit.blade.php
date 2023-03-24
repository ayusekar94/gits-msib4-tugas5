@extends('layout.app')

@section('content')
<main class="container-fluid px-5 mt-5">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Category</h1>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
        </div>
    @endif

    <form method="post" action="/category/{{ $category->id }}" id="myForm" enctype="multipart/form-data" class="row g-3">
        @method('PUT')
        @csrf
        <div class="col-md-12">
            <label for="desk" class="from-label">Name</label>
            <input type="text" class="form-control @error('product_name') is-invalid @enderror" id="exampleInputEmail1"
            aria-describedby="emailHelp" name="category_name" value="{{ $category->name }}" > 
            @error('product_name')
                <div class="invalid-feedback">
                    Nama tidak boleh kosong
                </div>
            @enderror
        </div>
        <div class="col-12">
          <button type="submit" class="btn btn-primary">Tambah</button>
        </div>
      </form>
</main>
@endsection