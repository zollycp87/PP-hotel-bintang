@extends('layouts.main-admin')
@section('content')
    <div class="pagetitle">
        <h1>Kelola Data Kategori Kamar</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Kelola Data Hotel</li>
                <li class="breadcrumb-item active">Kelola Data Kategori</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="d-flex align-items-center justify-content-end">
        <h5 class="card-title d-flex justify-content-end">
            <a href="{{ route('kelola-kategori.create') }}" class="btn btn-primary"><i class="bi bi-plus me-1"></i> Tambah Data</a>
        </h5>
    </div>
    @include('komponen.pesan')

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @forelse ($posts as $item)
            <div class="col">
                <div class="card">
                    <img src="{{ url('foto') . '/' . $item->img }}" class="card-img-top" alt="..." width="200px"
                        height="200px">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">{{ $item->nama_kategori }}</h5>
                            <h4 class="card-title">Rp {{ number_format($item->harga_kategori, 0, '.', ',') }}</h4>
                        </div>
                        <p class="card-text">
                            {{ $item->deskripsi }}
                            <br>
                            Kapasitas Maksimum : {{ $item->kapasitas }} orang
                        </p>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-end">

                            <a href="{{ route('kelola-kategori.edit', $item->id_kategori) }}"
                                class="btn btn-secondary bi bi-pen mx-1 tombol-edit"></a>

                            <form action="{{ route('kelola-kategori.destroy', $item->id_kategori) }}" method="post"
                                onsubmit="return confirm('Yakin akan menghapus data ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" name="submit" class="btn btn-danger bi bi-trash mx-1"></button>
                            </form>
                            {{-- <a href="" class="btn btn-danger bi bi-trash mx-1"></a> --}}
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-danger">
                Oops Data Kosong
            </div>
        @endforelse
    </div>

    <script>
        // Proses EDIT
        $('card').on('click', '.tombol-edit', function() {
            var id = $(this).data('id');
            alert(id);

            $.ajax({
                url: 'kelola-kategori/'+id+'edit/',
                type: 'GET',
                success: function(response) {
                    // $('#edit-modal .modal-content').html(response.html);
                    // $('#edit-modal').modal('show');
                    console.log(response.result);
                },
                error: function() {
                    // Tangani jika terjadi kesalahan
                }
            });
        });
    </script>
@endsection
@section('sidebar')
    @include('sidebar-admin')
@endsection
