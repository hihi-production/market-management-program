@extends('layouts.dashboard')
@section('title')
Data Admin
@endsection

@section('content')
<div class="page-heading">
  <div class="row">
    <div class="col-12 col-md-6 order-md-1 order-last">
      <h3>Data Admin</h3>
    </div>
  </div>
</div>

<section class="section">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col-6">
          <a href="{{ route('admin-data.create') }}" class="btn btn-sm btn-primary">
            <span>Tambah Data Admin</span>
          </a>
        </div>
        <div class="col-6">
          <span style="float: right">Jumlah Admin Sebanyak: <b>{{ count($datas) }}</b></span>
        </div>
      </div>
    </div>
    <div class="card-body">
      <table class="table table-striped" id="table1">
        <thead>
          <tr>
            <th>Nama</th>
            <th>Alamat</th>
            <th>No. Tlpn</th>
            <th>Aksi</th>
          </tr>
        </thead>

        <tbody>
          @foreach ($datas as $data)
          <tr>
            <td>{{ $data->name }}</td>
            <td>{{ $data->address }}</td>
            <td>{{ $data->contact }}</td>
            <td>
              <a href="{{ route('admin-data.edit', $data->id) }}" class="btn btn-sm btn-warning" title="Edit"><i
                  class="bi bi-pencil-square"></i></a>

              <button type="button" class="btn btn-sm btn-danger block" data-bs-toggle="modal"
                data-bs-target="#delete-{{ $data->id }}">
                <i class="bi bi-trash3-fill"></i>
              </button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

</section>
@endsection

@section('modal')
@foreach ($datas as $data)
<div class="modal fade text-left" id="delete-{{ $data->id }}" tabindex="-1" role="dialog"
  aria-labelledby="myModalLabel4" data-bs-backdrop="false" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel4">Hapus Data {{ $data->name }}</h4>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <i data-feather="x"></i>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah anda yakin ingin menghapus data <b>{{ $data->name }} ?</b></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
          <i class="bx bx-x d-block d-sm-none"></i>
          <span class="d-none d-sm-block">Close</span>
        </button>

        <form action="{{ route('admin-data.destroy', $data->id) }}" method="POST">
          @method('DELETE')
          @csrf
          <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
            <i class="bx bx-check d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Delete</span>
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
@endforeach
@endsection

@section('js')
<script>
  @if(Session::has('message'))
  Toastify({
        text: `{{ session('message') }}`,
        duration: 3000,
        close: true,
        gravity: "top", // `top` or `bottom`
        positionLeft: false, // `true` or `false`
        backgroundColor: `{{ 
            session('status') == 'success' ? 'linear-gradient(to right, #00b09b, #96c93d)' : 'linear-gradient(to right, #FF5F6D, #FFC371)' 
          }}`,
        }).showToast();
  @endif
</script>
@endsection