@extends('layouts.admin')

@section('title', 'Tambah Gallery | PGFC Admin')

@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">PGFC</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Tambah Gallery</a>
                                    </li>
                                </ol>
                            </div>
                            <h4 class="page-title">Tambah Gallery </h4>
                        </div>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('galleries.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <div class="form-group">
                                                    <label for="title">Title</label>
                                                    <input type="text" name="title"
                                                        class="form-control @error('title') is-invalid @enderror">
                                                    @error('title')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <div class="form-group">
                                                    <label for="image">Image</label>
                                                    <input type="file" name="image"
                                                        class="form-control @error('image') is-invalid @enderror">
                                                    @error('image')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
