@extends('layouts.admin')

@section('title', 'Edit PJ Tim | PGFC User')

@section('content')
    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">PGFC</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Edit Pj Pelatih</a>
                                    </li>
                                </ol>
                            </div>
                            <h4 class="page-title">Edit pJ Pelatih </h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                {{-- Konten --}}
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

                <div class="card shadow">
                    <div class="card-body">
                        <form action="{{ route('Pelatih.update', $data->id) }}" method="POST"enctype="multipart/form-data">
                            @method('POST')
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" placeholder="nama" value="{{ old('nama') }}">
                                        @error('nama')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="hp" class="form-label">hp</label>
                                        <input type="text" class="form-control @error('hp') is-invalid @enderror"
                                            name="hp" placeholder="jabatan" value="{{ old('hp') }}">
                                        @error('hp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="alamat" class="form-label">alamat</label>
                                        <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                            name="alamat" placeholder="masukkan alamat anda" value="{{ old('alamat') }}">
                                        @error('alamat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="foto" class="form-label">Foto</label>
                                        <input type="file" class="form-control @error('foto') is-invalid @enderror"
                                            name="foto" value="{{ old('foto') }}">
                                        @error('foto')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="ktp" class="form-label">Ktp</label>
                                        <input type="file"
                                            class="form-control @error('ktp') is-invalid @enderror"
                                            name="file"  value="{{ old('ktp') }}">
                                        @error('ktp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                              

                            
                                    {{-- <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" name="description" placeholder="Description">{{ $item->description }}</textarea>
                                    </div> --}}
                                    <button type="submit" class="btn btn-primary btn-block">Edit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                {{-- End Konten --}}
            </div>
            <!-- container -->
        </div>
        <!-- content -->
        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->
    @endsection
