@extends('layouts.dashboard')
@section('title')
Edit Data Admin
@endsection

@section('content')
<div class="page-heading">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Edit Data Admin</h3>
        </div>
    </div>
</div>

<section class="section">
    <div class="card">

        <div class="card-body">
            <form action="{{ route('admin-data.update', $data->id) }}" method="POST" class="form form-vertical">
                @csrf
                @method('PUT')
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Masukkan Nama Lengkap" value="{{ $data->name }}" autofocus required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username">Username <code>(jangan menggunakan spasi)</code></label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    id="username" name="username" placeholder="Contoh: jone"
                                    value="{{ $data->username }}" required>

                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-6">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="address">Alamat</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        placeholder="Masukan alamat" value="{{ $data->address }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="contact">No.Telpn</label>
                                    <input type="tel" class="form-control @error('contact') is-invalid @enderror"
                                        id="contact" name="contact" placeholder="Format: 6281..." required
                                        value="{{ $data->contact }}">
                                    @error('contact')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-1 mb-1">Ubah</button>
                            <a href="{{ route('admin-data.index') }}" type="button"
                                class="btn btn-light-secondary me-1 mb-1">Kembali</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</section>
@endsection